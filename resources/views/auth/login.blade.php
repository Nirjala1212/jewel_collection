<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Don’t have account? <a href="{{ route('register') }}">Register</a></p>

</body>
</html>