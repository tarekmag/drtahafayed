<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    public function edit()
    {
        return view('backend.seo.edit');
    }
}
