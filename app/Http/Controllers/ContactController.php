<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

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
        return view('includes.admin.contact.index', compact('contact', 'contact_keys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
