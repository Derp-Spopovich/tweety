<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        #cover{
            max-height: 223px;
            width: 700px;
        }
        #tweetImage{
            height: 200px;
            width: 430px;
        }
    </style>
</head>
<body>
    <div id="app">
        <section class="px-8 py-4 mb-6">
            <header class="container mx-auto">
                <h1>
                    <img src="/images/logo.svg" alt="tweety logo">
                </h1>
            </header>
        </section>

       {{$slot}}
       
       @if (session('success'))
        <div class="fixed bg-green-200 p-10 text-black-50" style="right: 20px;bottom:20px;">
            {{ session('success') }}
        </div>
       @endif
    </div>
    <script src="https://unpkg.com/turbolinks"></script> <!--for faster loading-->
</body>
</html>
