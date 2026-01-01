@extends('backend.app')

@section('content')
<div  class="main-content">
    <div  class="page-content">
<div class="container">
    <h2>Edit User</h2>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>

        <div class="mb-2">
            <label>Role</label>
            <select name="role" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}"
                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Permissions</label><br>
            @foreach($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]"
                        value="{{ $permission->name }}"
                        {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    {{ $permission->name }}
                </label><br>
            @endforeach
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
</div>
</div>
@endsection
