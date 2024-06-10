@extends('layouts.guest')
@section('content')

<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('Login')}}</h5>
    
    <p class="text-center small">{{__('Enter your email & password to login')}}</p>
    <hr />
</div>

<form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation">
    @csrf
    @if (session('status'))
        <div class="col-12"> {{ session('status') }} </div>
    @endif
    <div class="col-12">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <div class="input-group has-validation">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" autofocus required autocomplete="email">
            @error('email')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="col-12">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{old('password')}}"  required autocomplete="current-password">
            @error('password')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
    </div>

    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">{{ __('Login')}}</button>
    </div>
    <div class="col-12 text-center">
        @if (Route::has('password.request'))
            <p class="small mb-0">
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </p>
            <br/>
        @endif
        <p class="small mb-0">{{ __("Do not have account?")}} <a href="{{ route('register') }}">{{ __('Create an account')}}</a></p>
    </div>
</form>

@endsection
