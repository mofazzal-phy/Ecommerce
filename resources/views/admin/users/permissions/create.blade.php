@extends('backend.app')

@section('content')
<div class="main-content">
    <div class="page-content">
<div class="container">
    <h2>Add Permission</h2>

    <form method="POST" action="{{ route('admin.permissions.store') }}">
        @csrf

        <div class="mb-3">
            <label>Permission Name</label>
            <input type="text" name="name" class="form-control"
                   placeholder="e.g. user.view">
        </div>

        <button class="btn btn-primary">Create Permission</button>
    </form>
</div>
</div>
</div>
@endsection
