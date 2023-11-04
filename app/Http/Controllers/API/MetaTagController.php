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

class MetaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(MetaTags $metaTags)
    {
        return response()->json($metaTags);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMetaTagsRequest $request, MetaTags $metaTags)
    {
        dd($metaTags, $request);
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'content' => 'required|string',
            'page_id' => 'nullable|exists:pages,id',
        ]);

        $metaTags->update($data);

        return response()->json($metaTags);
    }

    public function updateMetaTagsGroup(Request $request, MetaTags $metaTags)
    {
        $validatedData = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'metaData' => 'nullable|array',
            'metaData.*.teg_id' => 'required|exists:meta_tags,id',
            'metaData.*.type_id' => 'nullable|exists:meta_teg_types,id',
            'metaData.*.value' => 'nullable|string|max:255',
            'metaData.*.content' => 'required|string|max:255',
        ]);

        if (isset($validatedData['metaData'])) {
            $ids = Arr::pluck($validatedData['metaData'], 'teg_id');
            $metaTags = MetaTags::findMany($ids)->keyBy('id');

            foreach ($validatedData['metaData'] as $meta) {
                if (!$metaTags->has($meta['teg_id'])) {
                    continue;
                }

                $metaTag = $metaTags->get($meta['teg_id']);

                unset($meta['teg_id']);

                $metaTag->update([
                    'page_id' => $validatedData['page_id'],
//                    'type_id' => $meta['type_id'],
//                    'value' => $meta['value'],
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
            'updatedMetaTags' =>$updatedMetaTags,
            'markup' => $markup,
            'message' => 'Meta tags updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaTags $metaTags)
    {
        $metaTags->delete();

        return response()->json(null, 204);
    }


}
