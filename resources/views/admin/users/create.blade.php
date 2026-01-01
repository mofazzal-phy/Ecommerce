<form action="{{ route('admin.users.store') }}" method="POST">
@csrf

<input type="text" name="name" placeholder="Name">
<input type="email" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">

<select name="role">
@foreach($roles as $role)
<option value="{{ $role->name }}">{{ $role->name }}</option>
@endforeach
</select>

<button type="submit">Create User</button>
</form>
