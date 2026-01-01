<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordCreateController extends Controller
{
    public function showPasswordCreateForm()
    {
        return view('backend.auth.passwordcreate');
    }

    public function storePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // OTP verify করার সময় user_id session এ রাখা ছিল ধরেই নিচ্ছি
        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('login')->withErrors('Invalid session');
        }

        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();

        // session clean
        session()->forget('otp_user_id');

        return redirect()->route('login')
            ->with('success', 'Password created successfully. Please login.');
    }
}

