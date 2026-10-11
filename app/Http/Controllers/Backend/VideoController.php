<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        return view('backend.videos.index');
    }

    public function create()
    {
        return view('backend.videos.create');
    }

    public function edit(Video $video)
    {
        return view('backend.videos.edit', compact('video'));
    }
}
