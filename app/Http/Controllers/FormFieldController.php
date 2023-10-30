<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function index(Form $form)
    {
        $fields = $form->fields;
        return view('form_fields.index', compact('fields', 'form'));
    }

    public function show(Form $form, FormField $field)
    {

        return view('form_fields.show', compact('form', 'field'));
    }

    public function create(Form $form)
    {
        return view('form_fields.create', compact('form'));
    }

    public function store(Request $request, Form $form)
    {
        $field = $form->fields()->create($request->all());

        // If a new field is added and there's no submit button, add it automatically.
        if (!$form->fields()->where('type', 'submit')->exists()) {
            $form->fields()->create([
                'label' => 'Submit',
                'name' => 'submit',
                'type' => 'submit',
            ]);
        }

        return redirect()->route('form_fields.index', $form->id)->with('success', 'Field added successfully.');
    }

    public function edit(Form $form, FormField $field)
    {
        return view('form_fields.edit', compact('form', 'field'));
    }

    public function update(Request $request, Form $form, FormField $field)
    {
        $field->update($request->all());

        return redirect()->route('form_fields.index', $form->id)->with('success', 'Field updated successfully.');
    }

    public function destroy(Form $form, FormField $field)
    {
        $field->delete();

        return redirect()->route('form_fields.index', $form->id)->with('success', 'Field deleted successfully.');
    }
}
