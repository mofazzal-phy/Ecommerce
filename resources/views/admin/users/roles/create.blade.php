{{-- <form method="POST" action="{{ route('admin.roles.store') }}">
@csrf
<input name="name" placeholder="Role Name">

@foreach($permissions as $permission)
<label>
<input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
{{ $permission->name }}
</label>
@endforeach

<button>Create Role</button>
</form>
 --}}
{{-- 
 @extends('backend.app')

@section('content')
<div class="main-content">
    <div class="page-content">
<div class="container">
    <h2>Add Role</h2>

    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf

        <div class="mb-3">
            <label>Role Name</label>
            <input type="text" name="name" class="form-control"
                   placeholder="e.g. editor">
        </div>

        <button class="btn btn-success">Create Role</button>
    </form>
</div>
</div>
</div>
@endsection
 --}}

 @extends('backend.app')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container">

            <h2>Add Role</h2>

            <form method="POST" action="{{ route('admin.roles.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="name" class="form-control"
                           placeholder="e.g. editor" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Permissions</label>

                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox"
                                           name="permissions[]"
                                           value="{{ $permission->name }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-success">Create Role</button>

            </form>

        </div>
    </div>
</div>
@endsection
