<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
    </head>

    <body class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <div class="container mx-auto py-8">
            @yield('content')
        </div>
    </body>
</html>
