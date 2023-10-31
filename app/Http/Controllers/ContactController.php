<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::all();
        if ($contact->isEmpty()) {
            $contact = Contact::create();
        } else {
            $contact = $contact->first();
        }
        $contact_keys = array_diff(array_keys($contact->toArray()), ['id', 'created_at', 'updated_at']);

        // Get any flash messages from the session
        $successMessage = Session::get('success_message');
        $errorMessage = Session::get('error_message');

        return view('includes.admin.contact.index', compact('contact', 'contact_keys', 'successMessage', 'errorMessage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        try {
            // Validation passed, create a new contact
            $contact = Contact::create($request->validated());

            // Set success flash message
            Session::flash('success_message', 'Contact created successfully');
        } catch (QueryException $e) {
            // Set error flash message for database query exception
            Session::flash('error_message', 'Error creating contact. Please try again.');
        }

        return redirect()->route('contacts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function edit()
//    {
//        $contacts = Contact::all();
//        return view('includes.admin.contact.edit', compact('contacts'));
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        try {
            // Validation passed, update the contact
            $contact->update($request->validated());

            // Set success flash message
            Session::flash('success_message', 'Contact updated successfully');
        } catch (ModelNotFoundException $e) {
            // Set error flash message for model not found exception
            Session::flash('error_message', 'Contact not found.');
        } catch (QueryException $e) {
            // Set error flash message for database query exception
            Session::flash('error_message', 'Error updating contact. Please try again.');
        }

        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
