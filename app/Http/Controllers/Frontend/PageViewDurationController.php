<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageViewDurationController extends Controller
{
    public function __invoke(Request $request, PageView $pageView): Response
    {
        abort_unless($pageView->session_id === $request->session()->getId(), 403);

        $seconds = $request->integer('seconds');

        abort_unless($seconds >= 1 && $seconds <= 1800, 422);

        if ($seconds > $pageView->duration_seconds) {
            $pageView->update(['duration_seconds' => $seconds]);
        }

        return response()->noContent();
    }
}
