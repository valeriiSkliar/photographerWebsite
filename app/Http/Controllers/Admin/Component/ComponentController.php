<?php

namespace App\Http\Controllers\Admin\Component;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Component\Component;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components  = Component::with('album.images')
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
        $componentData = $request->validate([
            'section_id' => 'required|integer|exists:sections,id',
            'name' => 'string|max:255',
            'type' => 'required|string|max:255',
            'album_id' => 'integer|nullable|exists:albums,id',
            'title' => 'nullable|string|max:255',
            'sub_text' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $details = $request->get('details');
        $component = Component::create(Arr::except($componentData, ['title','sub_text','description']));

        foreach ($details as $detail) {
            $component->details()->create($detail);
        }
        if (isset($componentData['album_id'])) {
            $album = Album::find($componentData['album_id']);

            if ($album) {
                $album->update([
                    'title' => $componentData['title'],
                    'sub_text' => $componentData['sub_text'],
                    'description' => $componentData['description']
                ]);
            }
        }

        return redirect()->route('components.index')->with('success', 'Component created successfully');

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
        $albums = Album::all();
        $sections = Section::all();
        return view('includes.admin.component.edit', compact('component', 'sections', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Component $component)
    {


        $componentData = $request->only([ 'section_id','name', 'type']);
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


        return redirect()->route('components.index')->with('success', 'Component updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Component $component)
    {
        $component->details()->delete();
        $component->delete();
        return redirect()->route('components.index')->with('success', 'Component deleted successfully');
    }
}
