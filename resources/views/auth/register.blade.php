@extends('auth.layouts.master')

@section('content')
<div class="card rounded-lg border-0 text-black">
    <div class="card-body px-4">
        <div class="d-flex align-items-center justify-content-center">
            <picture style="height: 40px;" class="d-inline-block">
                <source srcset="{{ asset('images/logo.webp') }}" type="image/webp">
                <source srcset="{{ asset('images/logo.png') }}" type="image/png">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" height="40">
            </picture>
        </div>
        <hr class="my-4" />
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="hidden" name="lang" value="{{ request()->attributes->get('_displayLanguage', 'en') }}">
            <div class="form-group">
                <label for="name" class="sr-only">{{ __('Full name') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ __('Full name') }}" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="sr-only">{{ __('E-Mail address') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail address') }}" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirmation" class="sr-only">{{ __('Confirm Password') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm password') }}" required autocomplete="current-confirm-password">
                </div>
            </div>

            <hr class="mb-4" />

            <div class="form-group mb-1">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
