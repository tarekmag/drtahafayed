<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DoctorBioController extends Controller
{
    public function edit()
    {
        return view('backend.bio.edit');
    }
}
