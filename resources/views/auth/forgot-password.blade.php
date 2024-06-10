@extends('layouts.guest')
@section('content')
<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('Forgot Password')}}</h5>
    <p class="text-center small">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
    <hr />
</div>
<form class="row g-3 needs-validation" method="POST" action="{{ route('password.email') }}">
    @csrf
    @if (session('status'))
        <div class="col-12"> {{ session('status') }} </div>
    @endif
    <div class="col-12">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" required autocomplete="email">
        @error('email')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
        <br />
    </div>
    

    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">{{ __('Email Password Reset Link')}}</button>
    </div>

    <div class="col-12 text-center">
        <p class="small mb-0"> <a href="{{ route('login') }}">{{ __('Login')}}</a></p>
    </div>

</form>
@endsection

