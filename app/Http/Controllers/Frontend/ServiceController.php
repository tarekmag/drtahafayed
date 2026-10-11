<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Support\Content;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function show(string $locale, string $service): View
    {
        $item = Content::service($service);

        abort_unless($item, 404);

        return view('frontend.service', [
            'service' => $item,
            'related' => Content::relatedServices($item),
        ]);
    }
}
