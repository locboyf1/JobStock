<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('content.contact.index');
    }

    public function store(ContactRequest $request)
    {
        $validated = $request->validated();
        Contact::create($validated);

        return redirect()->route('contact.index')->with('success', 'Gửi liên hệ thành công');
    }
}
