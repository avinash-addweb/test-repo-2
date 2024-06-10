@extends('layouts.guest')
@section('content')
<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">{{__('Create an Account')}}</h5>
    <p class="text-center small">{{__('Enter the details to create account')}}</p>
    <hr />
</div>
<form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}">
    @csrf
    @if (session('status'))
        <div class="col-12"> {{ session('status') }} </div>
    @endif
    <div class="col-12">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" autofocus required autocomplete="name">
        @error('name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
    </div>

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
        <label for="password_confirmation" class="form-label">{{ __('Role')}}</label>
        <select id="role" name="role"  class="form-control @error('password_confirmation') is-invalid @enderror" required>
            <option value="">{{ __('Select :record',['record'=>__('Role')]) }}</option>
            @foreach($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select>
        @error('role')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
        <br/>
    </div>

    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="terms" id="terms" required>
            <label class="form-check-label" for="terms">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="">'.__('Terms of Service').'</a>',
                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="">'.__('Privacy Policy').'</a>',
                ]) !!}
            </label>
            @error('terms')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
        </div>
    </div>
    @endif

    <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">{{ __('Create Account')}}</button>
    </div>

    <div class="col-12 text-center">
        <p class="small mb-0"> <a href="{{ route('login') }}">{{ __('Already have an account?')}}</a></p>
    </div>

</form>

@endsection



