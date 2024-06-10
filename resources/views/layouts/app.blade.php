<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('settings.website_title',config('app.name')) }}</title>
        <link rel="icon" href="{{asset('/images/favicon-icon-nbfc.png')}}" type="image/png" />

        <?php /* ?>
        {{--/ico.png--}}
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @livewireStyles
        <?php */ ?>
        
        @vite(['resources/js/app.js'])

        @include('layouts.partials.head')
        <head>

            <title>Laravel Bootstrap Datepicker</title>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>

            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

        </head>
    </head>
    <body class="font-sans antialiased">
        
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')
        <main id="main" class="main">
            @include('blocks.flash-message')
            @yield('content')
        </main>
        @include('layouts.partials.footer')
        
        <?php /* ?>
        <x-banner />
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('modals')
        @livewireScripts
        <?php */ ?>
    
        
        @include('layouts.partials.scripts')

    </body>
</html>
