<!DOCTYPE html>
<html>
<head>
    <title>User Register</title>
</head>
<body>

<h2>User Register</h2>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('register.post') }}">
    @csrf

    <input type="text" name="full_name" placeholder="Full Name" required><br><br>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>

    <input type="text" name="phone" placeholder="Phone"><br><br>

    <textarea name="address" placeholder="Address"></textarea><br><br>

    <button type="submit">Register</button>
</form>

<p>Already have account? <a href="{{ route('login') }}">Login</a></p>

</body>
</html>