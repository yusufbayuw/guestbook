<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts

    <style>
        .bg-blurred {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            filter: blur(8px); /* Adjust blur intensity */
            z-index: -1; /* Ensure the image stays behind content */
        }
    </style>
</head>

<body class="">
    <div class="bg-blurred"></div>
    {{ $slot }}
</body>

</html>