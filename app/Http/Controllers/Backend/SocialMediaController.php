<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    public function edit()
    {
        return view('backend.social.edit');
    }
}
