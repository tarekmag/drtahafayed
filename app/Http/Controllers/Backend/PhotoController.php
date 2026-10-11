<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        return view('backend.photos.index');
    }

    public function create()
    {
        return view('backend.photos.create');
    }

    public function edit(Photo $photo)
    {
        return view('backend.photos.edit', compact('photo'));
    }
}
