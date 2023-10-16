<?php

namespace App\Http\Controllers\Admin\Section;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section\Section;
use App\Models\SectionContent;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sections = Section::all();
        return view('includes.admin.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pages = Page::all();
        return view('includes.admin.section.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'page_id' => 'required|integer|exists:pages,id',
            'order' => 'required|integer',

            'font' => 'required|string|max:255',
            'font_color' => 'required|string|max:7',
            'background_color' => 'required|string|max:7',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_text' => 'nullable|string',
        ]);

        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put('backgrounds' . $filename, file_get_contents($image));

            $data['background_image'] = $filename;
        }


        $section = Section::create($data);

        $sectionContentData =  Arr::except($data, ['name', 'page_id', 'order']);
//        dd($sectionContentData);
        SectionContent::create(array_merge($sectionContentData, ['section_id' => $section->id]));

        return redirect()->route('sections.index')->with('success', 'Section and content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('includes.admin.section.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $pages = Page::all();

        $sectionContent = $section->content;

        return view('includes.admin.section.edit', compact('section', 'pages', 'sectionContent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'page_id' => 'required|integer|exists:pages,id',
            'order' => 'required|integer',

            'font' => 'required|string|max:255',
            'font_color' => 'required|string|max:7',
            'background_color' => 'required|string|max:7',
            'background_image' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_text' => 'nullable|string',
        ]);


        $sectionData = Arr::only($data, ['name', 'page_id', 'order']);
        $section->update($sectionData);

        $sectionContentData =  Arr::except($data, ['name', 'page_id', 'order']);
        $section->sectionContent->update($sectionContentData);

        return redirect()->route('sections.index')->with('success', 'Section and content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }
}
