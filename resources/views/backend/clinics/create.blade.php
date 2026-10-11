@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New branch</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('backend.clinics.index') }}">Clinics</a></li>
                                <li class="breadcrumb-item active">New branch</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <livewire:backend.clinic-form />

        </div>
    </div>
@endsection
