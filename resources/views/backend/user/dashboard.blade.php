@extends('backend.user-app')

@section('title', 'User Dashboard')

@section('content')

<div class="row g-4">

    <div class="col-12">
        <div class="card shadow-sm border-0"
             style="background: linear-gradient(135deg,#667eea,#764ba2); color:#fff;">
            <div class="card-body">
                <h3>👋 Welcome, {{ auth()->user()->name }}</h3>
                <p class="mb-0">
                    Role:
                    <strong>{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</strong>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <i class="bi bi-person-check fs-1 text-success"></i>
                <h5 class="mt-2">Profile Status</h5>
                <p class="text-muted">Active</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <i class="bi bi-shield-lock fs-1 text-warning"></i>
                <h5 class="mt-2">Permissions</h5>
                <p class="text-muted">
                    {{ auth()->user()->getAllPermissions()->count() }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <i class="bi bi-lightning-charge fs-1 text-primary"></i>
                <h5 class="mt-2">Account Type</h5>
                <p class="text-muted">
                    {{ ucfirst(auth()->user()->getRoleNames()->first() ?? 'user') }}
                </p>
            </div>
        </div>
    </div>

</div>

@endsection
