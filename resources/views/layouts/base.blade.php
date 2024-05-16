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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
