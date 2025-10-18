<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WellAll Dashboard</title>
    @vite(['resources/css/DashboardStyle.css', 'resources/js/app.js'])
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js'])

    @include('layouts.navigation')
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="Title">WellAll Healthcare Dashboard</div>
        <p class="subhead">Manage patients and records easily</p>
    </header>


</body>
</html>
