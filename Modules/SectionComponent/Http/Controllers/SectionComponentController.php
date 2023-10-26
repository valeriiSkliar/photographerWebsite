<?php

namespace Modules\SectionComponent\Http\Controllers;

use App\Models\Album;
use App\Models\Section\Section;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\SectionComponent\Entities\SectionsComponent;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class SectionComponentController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $components = SectionsComponent::all();
        return view('sectioncomponent::CRUD.index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $sections = Section::all();
        return view('sectioncomponent::CRUD.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {

        $data = $request->validate([
            'type' => 'required|in:standard,custom',
            'name' => 'required|unique:sections_components,name',
            'data' => 'nullable',
            'section_id' => 'required|exists:sections,id',
        ]);
        $componentName = slugify($data['name']);
        $data = array_merge($data, ['template_name' => $componentName]);
        switch ($data['type']) {
            case 'standard':
            {


                $frontendPath = resource_path("views/sectionComponents/frontend/$componentName.blade.php");
                $adminPath = resource_path("views/sectionComponents/admin/$componentName.blade.php");

                // Create frontend and admin templates
//                File::put($frontendPath, "");
//                File::put($adminPath, "");
                File::put($frontendPath, "<h1> Frontend template for $componentName </h1>");
                File::put($adminPath, "<h1> Admin template for editing $componentName </h1>");
                break;
            }
            case 'custom':
            {

                dd('custom');
                break;
            }

        }
        SectionsComponent::create($data);


        return redirect()->route('sections_component.index')->with('success', 'Component created successfully.');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $component = SectionsComponent::findOrFail($id);
        return view('sectioncomponent::CRUD.show', compact('component'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create('App\Forms\ComponentData', [
            'method' => 'POST',
            'url' => route('component-data.store', ['sections_components_id' => $id])
        ]);
        $sections = Section::all();
        $component = SectionsComponent::findOrFail($id);
        $ableData = null;
        if ($component->componentData) {
            $ableData = $this->getAbleData($component)->first();
        }

        return view(
            'sectioncomponent::CRUD.edit',
            compact(['component', 'sections', 'form', 'ableData'])
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:sections_components,name,' . $id,
            'data' => 'nullable',
            'section_id' => [
                'nullable',
                'sometimes',
                'exists:sections,id',
            ],
        ]);
        $data = $request->all();
        $componentName = slugify($data['name']);
        $data = array_merge($data, ['template_name' => $componentName]);

        $component = SectionsComponent::findOrFail($id);
        $component->update($data);

        return redirect()->route('sections_component.index')->with('success', 'Component updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $component = SectionsComponent::findOrFail($id);

        if ($component->type == 'standard') {
            $componentName = $component->template_name;
            $frontendPath = resource_path("views/sectionComponents/frontend/$componentName.blade.php");
            $adminPath = resource_path("views/sectionComponents/admin/$componentName.blade.php");

            // Delete frontend and admin templates
            File::delete([$frontendPath, $adminPath]);
        }

        $component->delete();

        return redirect()->route('sections_component.index')->with('success', 'Component deleted successfully.');
    }

    public function parsFrontendTemplate($id)
    {
        $adminTemplateContent = '';
        $component = SectionsComponent::findOrFail($id);

        if ($component->type == 'standard') {
            $componentName = $component->template_name;
            $frontendPath = resource_path("views/sectionComponents/frontend/$componentName.blade.php");
            $adminPath = resource_path("views/sectionComponents/admin/$componentName.blade.php");


//            $content = File::get($frontendPath);
//            $editfields = $this->parserService->extractEditableFields($content);
//            if ($editfields) {
//                $adminTemplateContent = $this->adminTemplateGenerator->generateInputFields($editfields);
//            }
//            if ($adminTemplateContent) {
//                File::put($adminPath, $adminTemplateContent);
//            }

        }


        return view('sectioncomponent::CRUD.show', compact(['component']));
    }

    private function getAbleData($componentData)
    {
        if ($componentData->componentData->first()->dataable_type === 'App\Models\Album') {
            return $album = Album::with('images')
                ->where('id', $componentData->componentData->first()->dataable_id)
                ->get();
        }
    }
}
