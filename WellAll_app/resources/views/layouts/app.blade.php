<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellAll System</title>

    {{-- Vite CSS --}}
    @vite([
        'resources/css/app.css'
    ])

    {{-- Font Awesome --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    {{-- Header --}}
    <header class="header">
        <div class="header-left">
            <div class="header-title">WellAll Healthcare</div>
            <p class="header-subtitle">Manage patients and records easily</p>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </header>


    {{-- Main Content --}}
    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>
