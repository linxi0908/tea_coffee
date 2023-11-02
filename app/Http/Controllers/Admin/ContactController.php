<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(){
        $contact = Contact::first();

        if ($contact === null) {
            return view('admin.pages.contact.create');
        }

        return redirect()->route('admin.contact.edit', $contact->id);
    }

    public function store(StoreContactRequest $request){
        $contact = Contact::first();

        if ($contact) {
            return redirect()->route('admin.contact.edit', $contact->id);
        }

        $validatedData = $request->validated();

        $contact = Contact::create($validatedData);

        $message = $contact ? 'Thông tin đã được thêm thành công.' : '';
        return redirect()->route('admin.contact.edit', $contact->id)
        ->with('message', $message);
    }

    public function edit($id){
        $contact = Contact::findOrFail($id);
        return view('admin.pages.contact.edit', ['contact' => $contact]);
    }

    public function update(UpdateContactRequest $request, $id){

        $validatedData = $request->validated();

        $contact = Contact::findOrFail($id);

        $contact->fill($validatedData);

        $contact->status = isset($validatedData['status']);

        if ($contact->isDirty()) {
            $contact->save();
            $message = 'Thông tin đã được cập nhật thành công.';
        } else {
            $message = 'Không có thông tin được cập nhật.';
        }

        return redirect()
        ->route('admin.contact.edit', $contact->id)
        ->with('message', $message);
    }
}
