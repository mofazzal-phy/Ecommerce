@extends('backend.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container mt-4">
                <h2>Edit Permission</h2>
                <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Permission Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
                    </div>
                    <button class="btn btn-primary">Update Permission</button>
                </form>
            </div>
        </div>
    </div>
@endsection
