<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Controller;
use App\Models\Component\Component;
use App\Models\MetaData\MetaTags;
use App\Models\MetaData\MetaTegType;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
//    public function __construct()
//    {
//    }

    public function index()
    {
        $this->authorize('view', auth()->user());
        return view('includes.admin.page.index');
    }

    public function create()
    {
        $metaTagTypes = MetaTegType::all();
        return view('includes.admin.page.create', compact('metaTagTypes'));
    }


    public function store(Request $request)
    {
        $page = null;
        $request->except(['_token', '_method']);
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:pages',
                'title' => 'required|string|max:255',
//                'meta_data' => 'required|string|max:255',
//                'metaData' => 'nullable|array',
//                'metaData.*.type_id' => 'required|exists:meta_teg_types,id',
//                'metaData.*.value' => 'required|string|max:255',
//                'metaData.*.content' => 'required|string|max:255',
            ]);
            $page = Page::create([
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
                'title' => $validatedData['title'],
//                'meta_data' => $validatedData['meta_data'],
            ]);

//            if (isset($validatedData['metaData'])) {
//                foreach ($validatedData['metaData'] as $meta) {
//                    MetaTags::create([
//                        'page_id' => $page->id,
//                        'type_id' => $meta['type_id'],
//                        'value' => $meta['value'],
//                        'content' => $meta['content']
//                    ]);
//                }
//            }
//
//            if (isset($validatedData['sectionData'])) {
//                $validatedData['sectionData'][0]['page_id'] = $page->id;
//                app(SectionController::class)->createSection($validatedData['sectionData']);
//            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if ($page) {
                $this->deleteTemplateFile($page->slug);
            }
            return redirect()->back()->with('error', 'There was an error creating the page and meta tags: ' . $e->getMessage());

        }
        $this->createTemplate($page->slug);

        return view('includes.admin.component.create')->with('success', 'Page and meta tags created successfully.');
    }

    public function show(Page $page)
    {
        $page = Page::with('components')
            ->where('id', $page->id)
            ->first();

        return view('includes.admin.page.show', compact('page', ));
    }

    public function edit(Page $page)
    {
        return view('includes.admin.page.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'title' => 'required|string|max:255',
            'meta_data' => 'required|string|max:255',
        ]);

        $page->update($request->all());
        return redirect()->route('admin.page.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index')->with('success', 'Page deleted successfully.');
    }

    private function createTemplate ($slug) {
        $filePath = resource_path('views/' . $slug . '.blade.php');
        $fileContent = "@extends('layouts.app')\n\n@section('content')\n";
        $fileContent .= "    <h1>{{ \$page->name }}</h1>\n";
        $fileContent .= "    <meta name=\"description\" content=\"{{ \$page->metadata }}\">\n";
        $fileContent .= "@endsection";

        File::put($filePath, $fileContent);
    }
    private function deleteTemplateFile ($slug) {

        $filePath = resource_path('views/' . $slug . '.blade.php');

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

    }

    public function attachComponent(Request $request, $pageId): \Illuminate\Http\JsonResponse
    {
        $page = Page::find($pageId);
        $component = Component::find($request->componentId);

        $isComponentAlreadyAddToPage = (
            $page
                ->components()
                ->where('components.id', $component?->id)
                ->get()
                ->first()?->id === $component?->id
        );
        if ($component) {
            if (!$isComponentAlreadyAddToPage) {
                $page->components()->attach($component?->id);
                $markup = view('includes.admin.component.ajax.component_list.row', compact('component', 'page'))->render();
                return response()
                    ->json([
                        'success' => true,
                        'message' => 'Component added successfully',
                        'markup' => $markup
                    ]);
            } else {
                return response()->json(['message' => 'Component is already on this page']);
            }
        } else {
            return response()->json(['error' => 'Invalid component or page id']);
        }
    }

    public function detachComponent(Request $request, $pageId): \Illuminate\Http\JsonResponse
    {
        $page = Page::find($pageId);
        $component = Component::find($request->componentId);

        if ($page && $component) {
            $page->components()->detach($component->id);
            return response()->json(['message' => 'Component detached successfully']);
        } else {
            return response()->json(['error' => 'Invalid component or page id']);
        }
    }

    public function updateAllComponentsList(Request $request, $pageId)
    {
        $page = Page::find($pageId);

        $components = $page->components();
        $markup = view('includes.admin.component.ajax.all-components-list', compact('components', 'page'))->render();
        return response()
            ->json([
                'success' => true,
                'message' => 'Component added successfully',
                'markup' => $markup
            ]);
    }

}
