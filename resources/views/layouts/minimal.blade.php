<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('settings.website_title',config('app.name')) }}</title>
        <link rel="icon" sizes="32x32" type="image/png" href="{{asset(config('constants.asset_prefix').config('settings.website_favicon_icon'))}}">
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="{{asset('/backend_assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('/backend_assets/css/style.css')}}" rel="stylesheet">
        
    </head>
    <body>
        <main>
            <div class="container">
                <div class="d-flex justify-content-center py-4">
                    <a href="/" class="logo d-flex align-items-center w-auto">
                        <img src="{{asset(config('constants.asset_prefix').config('settings.website_logo'))}}" alt="{{ config('settings.website_name',config('app.name')) }} logo" />
                        <span class="d-none d-lg-block">{{ config('settings.website_name',config('app.name')) }}</span>
                    </a>
                </div>
                @include('blocks.flash-message')
                @yield('content')

            </div>
        </main>

    </body>
</html>
