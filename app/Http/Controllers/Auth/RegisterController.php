<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\EmailOtp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('backend.auth.signup');
    }

public function register(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => null, // default not verified
        ]);

        // Assign default role
        $role = Role::firstOrCreate(['name' => 'user']);
        $user->assignRole($role);

        // Generate OTP
        $otp = rand(100000, 999999);

        EmailOtp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP email
        Mail::to($user->email)->send(new OtpMail($otp));

        // Redirect to OTP form
        return redirect()->route('otp.form')
            ->with('success', 'OTP sent to your email');

    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}




}
