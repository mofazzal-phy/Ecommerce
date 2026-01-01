@extends('backend.user-app')


@section('title', 'User Dashboard')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            {{-- Welcome Card --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm"
                         style="background: linear-gradient(135deg, #667eea, #764ba2); color: #fff;">
                        <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <h3 class="mb-1">
                                    👋 Welcome, {{ auth()->user()->name }}
                                </h3>
                                <p class="mb-0 opacity-75">
                                    You are logged in as
                                    <strong>{{ auth()->user()->getRoleNames()->first() ?? 'user' }}</strong>
                                </p>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <span class="badge bg-light text-dark px-3 py-2 fs-6">
                                    {{ now()->format('l, d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 text-center">
                        <div class="card-body">
                            <div class="avatar-sm mx-auto mb-3">
                                <span class="avatar-title rounded-circle bg-success-subtle text-success fs-24">
                                    👤
                                </span>
                            </div>
                            <h5 class="mb-1">Profile Status</h5>
                            <p class="text-muted mb-0">Active User</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 text-center">
                        <div class="card-body">
                            <div class="avatar-sm mx-auto mb-3">
                                <span class="avatar-title rounded-circle bg-warning-subtle text-warning fs-24">
                                    🔐
                                </span>
                            </div>
                            <h5 class="mb-1">Permissions</h5>
                            <p class="text-muted mb-0">
                                {{ auth()->user()->getAllPermissions()->count() }} Permissions
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 text-center">
                        <div class="card-body">
                            <div class="avatar-sm mx-auto mb-3">
                                <span class="avatar-title rounded-circle bg-info-subtle text-info fs-24">
                                    ⚡
                                </span>
                            </div>
                            <h5 class="mb-1">Account Type</h5>
                            <p class="text-muted mb-0">
                                {{ ucfirst(auth()->user()->getRoleNames()->first() ?? 'User') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Card --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-1">Quick Actions</h5>
                                <p class="text-muted mb-0">
                                    Manage your account and explore features
                                </p>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        🚪 Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection