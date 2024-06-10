<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('settings.website_title',config('app.name')) }}</title>
        <link rel="icon" href="{{asset('/images/favicon-icon-nbfc.png')}}" type="image/png" />
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="{{asset('/backend_assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('/backend_assets/css/style.css')}}" rel="stylesheet">
    </head>
    <body>


        <main>
            <div class="container">

                <section class="section register min-vh-10 d-flex flex-column align-items-center justify-content-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">

                            <div class="d-flex justify-content-center mt-4">
                                <a href="/" class="logo d-flex align-items-center w-auto">
                                    <img src="{{asset('/images/nbfc_logo.png')}}" alt="{{ config('settings.website_name',config('app.name')) }}">
                                </a>
                            </div>
                            <img src="{{ asset('/backend_assets/img/logo-big.png')}}" alt="{{ config('settings.website_name',config('app.name')) }} logo" />

                                @include('blocks.flash-message')
                                <div class="card1 mb-3">
                                    <div class="card-body">
                                        <br><br><br><br><br>
                                        
                                        <div class="row">
                                            <div class="col-md-12 text-center">

                                            @if (Route::has('login'))
                                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                                    @auth
                                                        <a href="{{ route('dashboard') }}" class="btn btn-success">{{__('Dashboard')}}</a>
                                                    @else
                                                        <a href="{{ route('login') }}" class="btn btn-primary">{{__('Login')}}</a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        @if (Route::has('register'))
                                                            <a href="{{ route('register') }}" class="btn btn-primary">{{__('Register')}}</a>
                                                        @endif
                                                    @endauth
                                                </div>
                                            @endif


                                            </div>
                                        </div>
                                        <br><br><br><br><br>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                                            </div>
                                        </div>
                                        
                                        
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
