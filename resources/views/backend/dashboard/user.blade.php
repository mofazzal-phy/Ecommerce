<h1>User Dashboard</h1>
<p>Welcome {{ auth()->user()->name }}</p>
<p>Role: {{ auth()->user()->getRoleNames()->first() }}</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
