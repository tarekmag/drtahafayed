<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Support\SiteAnalytics;

class DashboardController extends Controller
{
    public function index(SiteAnalytics $analytics)
    {
        return view('backend.dashboard', $analytics->dashboard());
    }
}
