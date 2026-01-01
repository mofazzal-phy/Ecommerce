<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailOtp;
use Illuminate\Http\Request;

class OtpVerificationController extends Controller
{
    public function showForm()
    {
        // ⚠️ এখানে otp দেখানোর দরকার নাই
        // কিন্তু blade এ {{ $otp }} আছে, তাই null পাঠাচ্ছি
        return view('backend.auth.emails.otp_form', [
            'otp' => null
        ]);
    }

public function verify(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6',
    ]);

    $otpRecord = EmailOtp::where('otp', $request->otp)
        ->where('expires_at', '>=', now())
        ->first();

    if (!$otpRecord) {
        return back()->withErrors([
            'otp' => 'Invalid or expired OTP',
        ]);
    }

    $user = $otpRecord->user;

    if (!$user) {
        return back()->withErrors([
            'otp' => 'User not found for this OTP',
        ]);
    }

    // ✅ mark email verified
    $user->update([
        'email_verified_at' => now(),
    ]);

    // ✅ delete OTP
    $otpRecord->delete();

    return redirect()->route('login')
        ->with('success', 'Email verified successfully. Please login now.');
}




}
