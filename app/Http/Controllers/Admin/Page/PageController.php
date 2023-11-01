<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Controller;
use App\Models\MetaData\MetaTags;
use App\Models\MetaData\MetaTegType;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function index()
    {
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
                'meta_data' => 'required|string|max:255',
                'metaData' => 'nullable|array',
                'metaData.*.type_id' => 'required|exists:meta_teg_types,id',
                'metaData.*.value' => 'required|string|max:255',
                'metaData.*.content' => 'required|string|max:255',
            ]);
            $page = Page::create([
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
                'title' => $validatedData['title'],
                'meta_data' => $validatedData['meta_data'],
            ]);

            if (isset($validatedData['metaData'])) {
                foreach ($validatedData['metaData'] as $meta) {
                    MetaTags::create([
                        'page_id' => $page->id,
                        'type_id' => $meta['type_id'],
                        'value' => $meta['value'],
                        'content' => $meta['content']
                    ]);
                }
            }

            if (isset($validatedData['sectionData'])) {
                $validatedData['sectionData'][0]['page_id'] = $page->id;
                app(SectionController::class)->createSection($validatedData['sectionData']);
            }

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
        return view('includes.admin.page.show', compact('page'));
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
}
