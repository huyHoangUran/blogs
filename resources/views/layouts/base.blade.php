<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('boxicons-2.1.4/css/boxicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstrap-icons-1.11.2/font/bootstrap-icons.min.css') }}" />
    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js', 'resources/js/comment.js', 'resources/js/like.js'])
    <title>@yield('title')</title>
</head>

<body>
    @include('components.message')
    @yield('content')
    <script src="{{ asset('resources/js/app.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
