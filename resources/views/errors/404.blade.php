{{-- @extends('errors::minimal') --}}
@extends('layouts.minimal')
@section('content')
<div class="container">
    @section('title', __('Not Found'))
    @section('code', '404')
    @section('message', __('Not Found'))
    <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <h1>{{__('404')}}</h1>
    <h2>{{__('The page you are looking for does not exist.')}}</h2>
    <a class="btn" href="{{ url('/') }}">{{__('Back to Home')}}</a>
    <img src="{{asset('\backend_assets\img\not-found.svg')}}" class="img-fluid py-5" alt="Page Not Found">
    </section>
</div>
@endsection