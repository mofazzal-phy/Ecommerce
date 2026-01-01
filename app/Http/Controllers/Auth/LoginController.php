<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.auth.signin');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // ❌ block login if email not verified
        if (!$user->email_verified_at) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Please verify your email first'
            ]);
        }

        // ✅ redirect based on role
        if ($user->hasAnyRole(['super-admin', 'admin', 'writer'])) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
}


}
