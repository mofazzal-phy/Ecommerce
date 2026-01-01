<form method="POST" action="{{ route('otp.verify') }}">
    @csrf

    <label>Enter OTP</label>
    <input type="text" name="otp" class="form-control" required>

    <button class="btn btn-primary mt-2">Verify</button>
</form>
