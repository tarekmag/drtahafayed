@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Message</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('backend.messages.index') }}">Messages</a></li>
                                <li class="breadcrumb-item active">{{ $contact->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-muted">Name</div>
                            <div>{{ $contact->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted">Phone</div>
                            <div dir="ltr">{{ $contact->phone }}</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-muted">Branch</div>
                            <div>{{ $contact->branch ?: '—' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted">Service</div>
                            <div>{{ $contact->service ?: '—' }}</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted">Message</div>
                        <div>{{ $contact->message ?: '—' }}</div>
                    </div>
                    <div class="text-muted">{{ $contact->created_at->format('Y-m-d h:i A') }}</div>
                </div>
            </div>

            <a href="{{ route('backend.messages.index') }}" class="btn btn-light">Back</a>

        </div>
    </div>
@endsection
