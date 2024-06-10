<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('settings.website_title',config('app.name')) }}</title>
{{--        <link rel="icon" sizes="32x32" type="image/png" href="{{asset(config('constants.asset_prefix').config('settings.website_favicon_icon'))}}">--}}

        <link rel="icon" href="{{asset('/images/favicon-icon-nbfc.png')}}" type="image/png" />


        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="{{asset('/backend_assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('/backend_assets/css/style.css')}}" rel="stylesheet">
        
    </head>
    <body>
        <main>
            <div class="container">

                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                
                                <div class="d-flex justify-content-center py-4">
                                    <a href="/" class="logo d-flex align-items-center w-auto">
                                        <img src="{{asset('/images/nbfc_logo.png')}}" alt="{{ config('settings.website_name',config('app.name')) }}">
                                    </a>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">

                                        @include('blocks.flash-message')
                                        @yield('content')
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </main>

    </body>
</html>
