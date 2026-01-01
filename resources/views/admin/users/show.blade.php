@extends('backend.app')

@section('content')
<div class="main-content">
    <div  class="page-content">
<div class="container">
    <h2>User Details</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Roles</div>
        <div class="card-body">
            @foreach($user->roles as $role)
                <span class="badge bg-primary">{{ $role->name }}</span>
            @endforeach
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Permissions</div>
        <div class="card-body">
            @foreach($user->getAllPermissions() as $permission)
                <span class="badge bg-success">{{ $permission->name }}</span>
            @endforeach
        </div>
    </div>

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        Back to List
    </a>
</div>
</div>
</div>
@endsection
