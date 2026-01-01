<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Email Verification OTP</h2>

    {{-- mail এর সময় otp দেখাবে --}}
    @if(!empty($otp))
        <p>Your OTP code is:</p>
        <h1>{{ $otp }}</h1>
        <p>This code will expire in 10 minutes.</p>
    @endif

    {{-- OTP submit form --}}
    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <input type="text" name="otp" placeholder="Enter OTP">
        <button type="submit">Verify OTP</button>
    </form>

    @if($errors->has('otp'))
        <p style="color:red">{{ $errors->first('otp') }}</p>
    @endif

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
</body>
</html>
