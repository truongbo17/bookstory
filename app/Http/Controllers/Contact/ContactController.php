<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.index');
    }

    public function send(ContactRequest $request){
        if (Contact::create($request->all())) {
            return redirect(url()->previous() . '#success')->with('success', 'Thank you for your contributions !');
        }
    }
}
