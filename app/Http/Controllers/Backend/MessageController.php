<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class MessageController extends Controller
{
    public function index()
    {
        return view('backend.messages.index');
    }

    public function show(Contact $contact)
    {
        if ($contact->read_at === null) {
            $contact->forceFill(['read_at' => now()])->save();
        }

        return view('backend.messages.show', compact('contact'));
    }
}
