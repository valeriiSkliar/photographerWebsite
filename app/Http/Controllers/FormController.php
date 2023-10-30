<?php

namespace App\Http\Controllers;

use App\Forms\ApplicationForm;
use App\Models\Form;
use App\Http\Controllers\Controller;
use App\Models\FormField;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::all();
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request )
    {
//        dd($request);
        $data = $request->validate([
            'name'=> 'required|string|max:255',
            'component_id' => 'nullable|exists:sections_components,id',
        ]);
        $form = Form::create($data);
//        dd($request->fields);
        if ($request->fields){
            foreach ($request->fields as $field) {
                FormField::create([
                    'label' => $field['label'],
                    'name' => $field['name'],
                    'type' => $field['type'],
                    'form_id' => $form->id,
                ]);
            }
        }

        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form, FormBuilder $formBuilder)
    {
        $formTemplate = $formBuilder->create(ApplicationForm::class, [
            'data' => ['formId' => $form->id]
        ]);

        return view('forms.show', compact('form', 'formTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        return view('forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        $form->update($request->all());

        return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();

        return redirect()->route('forms.index')->with('success', 'Form deleted successfully.');
    }
}
