<?php

namespace Modules\SectionComponent\Http\Controllers;

use App\Models\Album;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\SectionComponent\Entities\ComponentData;

class ComponentDataController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $sectionComponentsData = ComponentData::all();

        return view('sectioncomponent::index', compact(['sectionComponentsData']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('sectioncomponent::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {
        $data = $request->all();
//        dd($data);
        if ($data['album_id']) {
            $album = Album::find($data['album_id']);
            $componentData = ComponentData::create($request->all());
            $album->componentData()->save($componentData);
        }
//        dd();


//        dd($componentData);
//        app(SectionComponentController::class)->edit($componentData->sections_components_id, $formBuilder);

        return redirect()->back()->with(json_encode($componentData));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        return view('sectioncomponent::CRUD.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        return view('sectioncomponent::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return false|string
     */
    public function destroy($id)
    {
//        dd($id);
        $data = ComponentData::findOrFail($id);

        $data->delete();

        return response()->json(ComponentData::all());
    }
}
