@extends('layouts.guest')
@section('content')
<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('Confirmation')}}</h5>
    <p class="text-center small">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
    <hr />
</div>
<form class="row g-3 needs-validation" method="POST" action="{{ route('password.confirm') }}">
    @csrf
    @if (session('status'))
        <div class="col-12"> {{ session('status') }} </div>
    @endif


    <div class="col-12">
        <label for="password" class="form-label">{{ __('Password')}}</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autofocusrequired autocomplete="current-password">
        @error('password')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100">{{ __('Confirm')}}</button>
    </div>

</form>

@endsection
