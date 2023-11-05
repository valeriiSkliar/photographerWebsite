<?php

namespace App\Http\Controllers\API;

use App\Models\MetaData\MetaTags;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMetaTagsRequest;
use App\Http\Requests\UpdateMetaTagsRequest;
use App\Models\MetaData\MetaTagsNameVariants;
use App\Models\MetaData\MetaTagsPropertyVariants;
use App\Models\MetaData\MetaTegType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function Laravel\Prompts\error;

class MetaTagController extends Controller
{

    public function index()
    {
//        return MetaTags::find(3);
        $names = MetaTagsNameVariants::all();
        $properties = MetaTagsPropertyVariants::all();
        $types = MetaTegType::all();

        return response()->json([
//            'meta_tags' => MetaTags::with('page')->get(),
            'name' => $names,
            'property' => $properties,
            'types' => $types,
        ]);
    }

    public function store(Request $request)
    {
//        dd($request);
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'content' => 'required|string',
            'page_id' => 'nullable|exists:pages,id',
        ]);

        $metaTag = MetaTags::create($data);

        return response()->json($metaTag, 201);
    }

    public function show(MetaTags $metaTags)
    {
        return response()->json($metaTags);
    }

    public function update(UpdateMetaTagsRequest $request, MetaTags $metaTags)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'content' => 'required|string',
            'page_id' => 'nullable|exists:pages,id',
        ]);

        $metaTags->update($data);

        return response()->json($metaTags);
    }

    public function updateMetaTagsGroup(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'page_id' => 'required|exists:pages,id',
                'metaData' => 'nullable|array',
                'metaData.*.teg_id' => 'required|exists:meta_tags,id',
                'metaData.*.type_id' => 'required|exists:meta_teg_types,id',
                'metaData.*.value' => 'required|string|max:255',
                'metaData.*.content' => 'required|string|max:255',
            ]);

            if (isset($validatedData['metaData'])) {
                $ids = Arr::pluck($validatedData['metaData'], 'teg_id');
                $metaTags = MetaTags::findMany($ids)->keyBy('id');

                foreach ($validatedData['metaData'] as $meta) {
                    if (!$metaTags->has($meta['teg_id'])) {
                        continue;
                    }
//                    dd($meta);
                    $metaTag = $metaTags->get($meta['teg_id']);

                    unset($meta['teg_id']);

                    $metaTag->update([
                        'page_id' => $validatedData['page_id'],
                        'type_id' => $meta['type_id'],
                        'value' => $meta['value'],
                        'content' => $meta['content']
                    ]);

                }
            }
            $updatedMetaTags = MetaTags::findMany($ids)->keyBy('id');
            $markup = view(
                'includes.admin.component.ajax.metaTags.edit-meta-form',
                compact(
                    'updatedMetaTags'
                ))->render();
            return response()->json([
                'success' => true,
                'updatedMetaTags' => $updatedMetaTags,
                'markup' => $markup,
                'message' => 'Meta tags updated successfully'
            ]);

        } catch (\Exception $e) {
            return response(
                [
                    'error' => true,
                    'message' => 'Meta tags update error!' . $e->getMessage()
                ], 500
            );
        }
    }

    public function destroy($id)
    {
        try {
            $metaTag = MetaTags::findOrFail($id);
            if ($metaTag) {
                $metaTag->delete();
            }
            return response(
                [
                    'success' => true,
                    'message' => 'Meta tag delete successfully!'
                ], 200
            );

        } catch (\Exception $exception) {
            return response(
                [
                    'error' => true,
                    'message' => 'Meta tag delete error!' . $exception->getMessage()
                ], 204
            );
        }


    }

    public function getMarkUp(Request $request)
    {
//
        $pageId = $request['page_id'];
//        dd($pageId);
        $updatedMetaTags = MetaTags::where('page_id', $pageId)->get();

        try {
            $markup = view(
                'includes.admin.component.ajax.metaTags.edit-meta-form',
                compact(
                    'updatedMetaTags'
                ))->render();
            return response()->json([
                'success' => true,
                'updatedMetaTags' => $updatedMetaTags,
                'markup' => $markup,
                'message' => 'Edit meta tags '
            ]);


        }catch (\Exception $exception) {

        }
    }

    public function addNewRow(Request $request)
    {
        $type = $request['type'];
        $typeId = $request['type_id'];
        $pageId = $request['page_id'];
        try {
            $meta_tag = MetaTags::create([
                'type_id' => $typeId,
                'page_id' => $pageId
            ]);
            $meta_tags = MetaTags::where('page_id', $pageId)->get();


            $markup = view(
                'includes.admin.component.ajax.metaTags.create-meta-form',
                compact(
                    'type', 'meta_tags', 'meta_tag'
                ))->render();

            return response()->json([
                'success' => true,
//                'updatedMetaTags' =>$updatedMetaTags,
                'markup' => $markup,
                'message' => 'Add meta tag, input value and content'
            ]);
        } catch (\Exception $exception) {
            return response(
                [
                    'error' => true,
                    'message' => 'Error during add new row!' . $exception->getMessage()
                ], 500
            );
        }
    }

}
