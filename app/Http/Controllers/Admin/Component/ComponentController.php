<?php

namespace App\Http\Controllers\Admin\Component;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Component\Component;
use App\Models\Page;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components = Component::with('album.images')
            ->get();
        return view('includes.admin.component.index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $albums = Album::all();
        $sections = Section::all();
        return view('includes.admin.component.create', compact('sections', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $page = null;
        $componentData = $request->validate([
            'name' => 'string|max:255',
            'album_id' => 'integer|nullable|exists:albums,id',
            'page_id' => 'integer|nullable|exists:pages,id',
//            'title' => 'nullable|string|max:255',
//            'sub_text' => 'nullable|string|max:255',
//            'description' => 'nullable|string|max:1000',
        ]);

        $details = $request->get('details');
        $component = Component::create(Arr::except($componentData, ['page_id', 'title', 'sub_text', 'description']));

        if ($component) {
            $page = Page::find($componentData['page_id']);
            $page->components()->attach($component->id);
        }

        foreach ($details as $detail) {
            $component->details()->create($detail);
        }


        if ($request->ajax()) {
            $markup = view('includes.admin.component.ajax.component_list.row', compact('component', 'page'))->render();
            return response()->json([
                'success' => true,
                'component' => $component,
                'markup' => $markup,
                'message' => 'Component created successfully'
            ], 201);
        } else {
            return redirect()->route('components.index')->with('success', 'Component created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component)
    {
        $component->load('album');

        return view('includes.admin.component.show', compact('component'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Component $component)
    {
        $page = $component->pages->first();
        $albums = Album::all();
        $sections = Section::all();

        if ($request->ajax()) {
            $markup = view('includes.admin.component.ajax.edit-form', compact('page', 'component'))->render();
            return response()->json([
                'success' => true,
                'component' => $component,
                'markup' => $markup,
                'message' => 'Component created successfully'
            ], 201);
        } else {
            return view('includes.admin.component.edit', compact('page', 'component', 'sections', 'albums'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Component $component, $id)
    {

//        dd($request);
        if (!$component->id) {
            $component = Component::findOrFail($id);
        }
        $page = $component->pages->first();
        $componentData = $request->validate([
            'name' => 'string|max:255',
            'album_id' => 'integer|nullable|exists:albums,id',
            'isVisible' => 'string|nullable',
//            'page_id' => 'integer|nullable|exists:pages,id',
        ]);
        if (array_key_exists('isVisible', $componentData)) {
            $componentData = array_merge($componentData, ['isVisible' => 'off']);
        } else {
            $componentData = array_merge($componentData, ['isVisible' => 'on']);
        }
        $details = $request->get('details');

        $existingDetailIds = $component->details->pluck('id')->toArray();
        $submittedDetailIds = array_column($details, 'id');

        foreach ($existingDetailIds as $id) {
            if (!in_array($id, $submittedDetailIds)) {
                $component->details()->where('id', $id)->delete();
            }
        }

        foreach ($details as $detail) {
            if (isset($detail['id'])) {
                $component->details()->where('id', $detail['id'])->update($detail);
            } else {
                $component->details()->create($detail);
            }
        }

        $component->update($componentData);
        $component->details()->delete();

        foreach ($details as $detail) {
            $component->details()->create($detail);
        }

        if ($request->ajax()) {
            $markup = view(
                'includes.admin.component.ajax.component_list.row',
                compact(
                    'component', 'page'
                ))->render();
            return response()->json([
                'success' => true,
                'component' => $component,
                'markup' => $markup,
                'message' => 'Component updated successfully'
            ], 201);
        } else {
            return redirect()->route('components.index')->with('success', 'Component updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Component $component)
    {
//        dd($request);
        $page = Page::with('components')
            ->where('id', $request->page_id)
            ->first();        $component->details()->delete();
        $component->delete();
        if ($request->ajax()) {
//            $markup = view('includes.admin.component.ajax.component_list.row', compact('component'))->render();
            return response()->json([
                'success' => true,
//                'id' => $id,
//                'markup' => $markup,
                'message' => 'Component deleted successfully'
            ], 201);
        } else {
            Session::flash('success_message','Component deleted successfully.');
            return redirect()->route('admin.pages.show', ['page' => $page->id]);
        }
    }

    public function getFormMarkup($id)
    {
//        dd($id);
        $albums = Album::all();
        $page = Page::with('components')
            ->where('id', $id)
            ->first();
        $markup = view('includes.admin.component.ajax.create-form', compact(['albums', 'page']))->render();
        return response()->json(['markup' => $markup]);
    }
}
