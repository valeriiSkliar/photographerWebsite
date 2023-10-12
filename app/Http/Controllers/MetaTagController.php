<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetaTagRequest;
use App\Models\MetaTag;

class MetaTagController extends Controller
{
    public function index()
    {
        return MetaTag::all();
    }

    public function store(MetaTagRequest $request)
    {
        return MetaTag::create($request->validated());
    }

    public function show(MetaTag $metaTag)
    {
        return $metaTag;
    }

    public function update(MetaTagRequest $request, MetaTag $metaTag)
    {
        $metaTag->update($request->validated());

        return $metaTag;
    }

    public function destroy(MetaTag $metaTag)
    {
        $metaTag->delete();

        return response()->json();
    }
}
