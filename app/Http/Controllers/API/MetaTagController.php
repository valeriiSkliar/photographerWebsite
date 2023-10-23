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
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'value' => 'nullable|string|max:255',
            'content' => 'required|string',
            'page_id' => 'nullable|exists:pages,id',
        ]);

        $metaTags->update($data);

        return response()->json($metaTags);
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
