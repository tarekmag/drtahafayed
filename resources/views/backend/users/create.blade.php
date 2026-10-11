@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New user</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('backend.users.index') }}">Users</a></li>
                                <li class="breadcrumb-item active">New user</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <livewire:backend.user-form />

        </div>
    </div>
@endsection
