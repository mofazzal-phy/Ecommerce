@extends('backend.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container mt-4">
                <h2>Edit Role</h2>
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Role Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Assign Permissions</label>
                        <div>
                            @foreach ($permissions as $permission)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->name }}"
                                        {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button class="btn btn-primary">Update Role</button>
                </form>
            </div>
        </div>
    </div>
@endsection
