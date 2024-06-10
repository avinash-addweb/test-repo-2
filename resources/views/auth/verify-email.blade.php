@extends('layouts.guest')
@section('content')
<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('Email Verification')}}</h5>
    <p class="text-center small"> {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
    <hr />
</div>

@if (session('status') == 'verification-link-sent')
<div  class="col-12">
    {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
</div>
@endif

<form class="row g-3 needs-validation" method="POST" action="{{ route('verification.send') }}">
    @csrf
    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">{{ __('Resend Verification Email') }}</button>
        <br />
    </div>
</form>

<div class="col-12">
    <a href="{{ route('profile.show') }}" class="" > {{ __('Edit Profile') }}</a>
    <br />
</div>

<div class="col-12">
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="">
            {{ __('Log Out') }}
        </button>
    </form>
</div>
@endsection