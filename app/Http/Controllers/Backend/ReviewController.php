<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PatientReview;

class ReviewController extends Controller
{
    public function index()
    {
        return view('backend.reviews.index');
    }

    public function show(PatientReview $patientReview)
    {
        return view('backend.reviews.show', ['review' => $patientReview]);
    }
}
