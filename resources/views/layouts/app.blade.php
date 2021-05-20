<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laragram</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>

    <script>
        if (localStorage.theme === 'dark' || (!'theme' in localStorage && window.matchMedia('(prefers-color-scheme: dark)').matches)) {

            document.querySelector('html').classList.add('dark')

        } else if (localStorage.theme === 'dark') {

            document.querySelector('html').classList.add('dark')

        }
    </script>
</head>

<body class="font-sans antialiased ">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-800 transition duration-700">
        @include('layouts.navigation')
        <!-- Page Content -->
        <main class="duration-700">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
