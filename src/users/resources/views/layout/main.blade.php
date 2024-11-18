<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <!-- Bootstrap CSS -->
    @vite(['resources/sass/app.scss',   'resources/js/app.js'])
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->

</body>
</html>
