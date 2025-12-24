<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('is_processed', 'asc')->orderByDesc('created_at')->get();

        return view('admin.contact.index', ['contacts' => $contacts]);
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        if (! $contact) {
            return redirect()->route('admin.contact.index')->with('error', 'Liên hệ không tồn tại');
        }

        return view('admin.contact.show', ['contact' => $contact]);
    }

    public function status($id)
    {
        $contact = Contact::find($id);
        if (! $contact) {
            return redirect()->route('admin.contact.index')->with('error', 'Liên hệ không tồn tại');
        }

        $contact->update([
            'is_processed' => ! $contact->is_processed,
        ]);

        return redirect()->route('admin.contact.index')->with('success', 'Liên hệ đã đổi trạng thái');

    }
}
