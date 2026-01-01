<h2>Enter OTP to verify your email</h2>

<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input type="text" name="otp" placeholder="Enter OTP" required>
    <button type="submit">Verify OTP</button>
</form>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($errors->has('otp'))
    <p style="color:red">{{ $errors->first('otp') }}</p>
@endif
