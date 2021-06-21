@extends('auth.layouts.master')

@section('content')
@isset ($alert)
    <x-alert type="info"><h6 class="mb-0">{{ $alert }}</h6></x-alert>
@endisset
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
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="sr-only">{{ __('E-Mail address') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                <div class="text-right">
                    <small>
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </small>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label text-muted" for="remember">{{ __('Remember me') }}</label>
                </div>
            </div>

            <hr class="mb-4" />

            <div class="form-group mb-1">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
