<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
<div class="flex flex-col">
    <div class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col justify-around h-full">
            <div>
                <h1 class="mb-6 text-gray-600 text-center font-light tracking-wider text-4xl sm:mb-8 sm:text-6xl">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <ul class="flex flex-col space-y-2 sm:flex-row sm:flex-wrap sm:space-x-8 sm:space-y-0">
                    <li>
                        @auth
                            <a href="{{ url('/tweet') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase px-15">{{ __('Tweets!') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase px-5">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase px-7">{{ __('Register') }}</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
