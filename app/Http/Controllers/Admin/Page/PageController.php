<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view(
            'includes.admin.page.index',
            compact('pages'
            ));
    }

    public function create()
    {
        return view('includes.admin.page.create');
    }

    public function store(Request $request)
    {
        $request->except(['_token', '_method']);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'title' => 'required|string|max:255',
            'meta_data' => 'required|string|max:255',
        ]);

        Page::create($data);
        return redirect()->route('admin.page.index')->with('success', 'Page created successfully.');
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
}