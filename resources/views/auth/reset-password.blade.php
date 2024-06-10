@extends('layouts.guest')
@section('content')
<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('Reset Password')}}</h5>
    <hr />
</div>
<form class="row g-3 needs-validation" method="POST" action="{{ route('password.update') }}">
    @csrf
    @if (session('status'))
        <div class="col-12"> {{ session('status') }} </div>
    @endif
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="col-12">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" required autocomplete="email">
        @error('email')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
    </div>

    <div class="col-12">
        <label for="password" class="form-label">{{ __('Password')}}</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" required autocomplete="new-password">
        @error('password')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
    </div>

    <div class="col-12">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password')}}</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" value="" required autocomplete="new-password">
        @error('password_confirmation')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">{{ __('Reset Password')}}</button>
    </div>

</form>
@endsection
