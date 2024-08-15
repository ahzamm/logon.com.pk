<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    public function index()
    {
        $contact_information = ContactInformation::first();
        return view('admin.contact-information.index', compact('contact_information'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'address_url' => 'required',
            'phone_slogan' => 'required',
            'email_slogan' => 'required',
            'address_slogan' => 'required',
            'cordinates' => 'required',
        ]);

        $contact_information = ContactInformation::first();

        $contact_information->phone = $request['phone'];
        $contact_information->email = $request['email'];
        $contact_information->address = $request['address'];
        $contact_information->address_url = $request['address_url'];
        $contact_information->phone_slogan = $request['phone_slogan'];
        $contact_information->email_slogan = $request['email_slogan'];
        $contact_information->address_slogan = $request['address_slogan'];
        $contact_information->cordinates = $request['cordinates'];
        $contact_information->save();

        return redirect()->route('contact-information.index')->with('success', 'Contact Information updated successfully!');
    }
}
