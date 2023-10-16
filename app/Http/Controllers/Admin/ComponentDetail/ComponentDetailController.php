<?php

namespace App\Http\Controllers\Admin\ComponentDetail;

use App\Http\Controllers\Controller;
use App\Models\ComponentDetail\ComponentDetail;
use Illuminate\Http\Request;

class ComponentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = ComponentDetail::all();
        return view('component_details.index', ['details' => $details]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('component_details.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'component_id' => 'required|integer|exists:components,id',
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        ComponentDetail::create($validatedData);
        return redirect()->route('component_details.index')->with('success', 'Detail created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(ComponentDetail $componentDetail)
    {
        return view('component_details.show', ['detail' => $componentDetail]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComponentDetail $componentDetail)
    {
        return view('component_details.edit', ['detail' => $componentDetail]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComponentDetail $componentDetail)
    {
        $validatedData = $request->validate([
            'component_id' => 'required|integer|exists:components,id',
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $componentDetail->update($validatedData);
        return redirect()->route('component_details.index')->with('success', 'Detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComponentDetail $componentDetail)
    {
        //
    }
}
