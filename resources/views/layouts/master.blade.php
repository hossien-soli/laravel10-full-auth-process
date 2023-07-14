<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageTitle }}</title>
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    @yield('head_links')
</head>
<body>
    @include('partials.navigation')

    <div class="py-3 container">
        @include('partials.flash_messages')
        @yield('content')
    </div>

    @yield('end_links')
</body>
</html>
