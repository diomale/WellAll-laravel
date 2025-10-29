<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background: #43a047;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
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
