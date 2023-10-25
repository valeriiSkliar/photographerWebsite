<?php

namespace Modules\SectionComponent\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SectionComponent\Services\AdminTemplateGenerator;
use Modules\SectionComponent\Services\ParserService;

class BaseController extends Controller
{
    public ParserService $parserService;
    public AdminTemplateGenerator $adminTemplateGenerator;


    public function __construct( ParserService $parserService, AdminTemplateGenerator $adminTemplateGenerator)
    {
        $this->parserService = $parserService;
        $this->adminTemplateGenerator = $adminTemplateGenerator;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sectioncomponent::index');
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
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('sectioncomponent::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
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
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
