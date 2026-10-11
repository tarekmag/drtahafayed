@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Review</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('backend.reviews.index') }}">Reviews</a></li>
                                <li class="breadcrumb-item active">{{ $review->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="text-muted">Name</div>
                            <div>{{ $review->name }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted">Rating</div>
                            <div>{{ $review->rating }} / 5</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted">Language</div>
                            <div>{{ strtoupper($review->locale) }}</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted">Review</div>
                        <div>{{ $review->body }}</div>
                    </div>
                    <div class="text-muted mb-3">{{ $review->created_at->format('Y-m-d h:i A') }}</div>
                    <livewire:backend.review-actions :patient-review="$review" />
                </div>
            </div>

        </div>
    </div>
@endsection
