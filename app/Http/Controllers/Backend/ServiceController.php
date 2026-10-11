<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return view('backend.services.index');
    }

    public function create()
    {
        return view('backend.services.create');
    }

    public function edit(Service $service)
    {
        return view('backend.services.edit', compact('service'));
    }
}
