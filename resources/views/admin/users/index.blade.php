@extends('backend.app')

@section('content')
<div class="main-content">
    <div  class="page-content">
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>User List</h2>

    <div>
        @hasanyrole('super-admin|admin')
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-sm">
            + Add Role
        </a>

        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
            + Add Permission
        </a>
        @endhasanyrole
    </div>
</div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.users.show', $user->id) }}"
                    class="btn btn-sm btn-info">View</a>

                    <a href="{{ route('admin.users.edit', $user->id) }}"
                    class="btn btn-sm btn-warning">Edit</a>

                    @hasanyrole('super-admin|admin')
                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                        method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                    @endhasanyrole

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection
