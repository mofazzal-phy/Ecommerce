<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Carbon;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('roles', 'permissions');

        return view('admin.users.show', compact('user'));
    }

   public function create()
{
    $roles = Role::all();
    $permissions = Permission::all(); // ← এইটাই permissions

    return view('admin.users.create', compact('roles', 'permissions'));
}

/*    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required',
        'permissions' => 'array'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $user->assignRole($request->role);

    if ($request->has('permissions')) {
        $user->syncPermissions($request->permissions);
    }

    return redirect()->route('dashboard')
        ->with('success', 'User created successfully.');
} */

        
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required',
        'permissions' => 'array'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'email_verified_at' => Carbon::now(), // ✅ auto verified
    ]);

    $user->assignRole($request->role);

    if ($request->has('permissions')) {
        $user->syncPermissions($request->permissions);
    }

    return redirect()->route('dashboard')
        ->with('success', 'User created and auto verified successfully.');
}
public function edit(User $user)
{
    $roles = Role::all();
    $permissions = Permission::all();

    $user->load('roles', 'permissions');

    return view('admin.users.edit', compact('user', 'roles', 'permissions'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required',
        'permissions' => 'array'
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // role update
    $user->syncRoles([$request->role]);

    // permission update
    $user->syncPermissions($request->permissions ?? []);

    return redirect()
        ->route('admin.users.show', $user->id)
        ->with('success', 'User updated successfully');
}

public function destroy(User $user)
{
    $user->delete();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User deleted successfully');
}


}
