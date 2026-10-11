<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clinic;

class ClinicController extends Controller
{
    public function index()
    {
        return view('backend.clinics.index');
    }

    public function create()
    {
        return view('backend.clinics.create');
    }

    public function edit(Clinic $clinic)
    {
        return view('backend.clinics.edit', compact('clinic'));
    }
}
