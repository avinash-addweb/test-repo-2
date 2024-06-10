{{-- @extends('errors::minimal') --}}
@extends('layouts.minimal')
@section('content')
<div class="container">
    @section('title', __('Service Unavailable'))
    @section('code', '503')
    @section('message', __('Service Unavailable'))
    <section class="section error-503 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <h1>{{__('Maintenance Mode')}} ({{__('503')}})</h1>
    <h2>{{__('We will be back soon.')}}!!</h2>
    <img src="{{asset('\backend_assets\img\not-found.svg')}}" class="img-fluid py-5" alt="Service Unavailable">
    </section>
</div>
@endsection