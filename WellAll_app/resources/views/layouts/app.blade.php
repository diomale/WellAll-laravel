<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellAll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js'])
    @include('layouts.navigation')
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">WellAll System</a>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

</body>
</html>
