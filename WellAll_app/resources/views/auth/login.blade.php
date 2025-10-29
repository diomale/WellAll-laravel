@vite(['resources/css/LoginStyle.css'])
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1 class="main-title">WellAll Login</h1>

    <div class="login-box">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
