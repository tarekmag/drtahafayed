<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class ContactDataController extends Controller
{
    public function edit()
    {
        return view('backend.contacts.edit');
    }
}
