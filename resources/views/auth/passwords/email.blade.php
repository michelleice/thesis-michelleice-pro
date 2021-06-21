@extends('auth.layouts.master')

@section('content')
@if (session('status'))
    <x-alert type="success"><h6 class="mb-0">{{ session('status') }}</h6></x-alert>
@endif
<div class="card rounded-lg border-0 text-black">
    <div class="card-body px-4">
        <h1 class="text-center text-ff-lilita">{{ config('app.name') }}</h1>
        <h4 class="text-center">@lang('by')</h4>
        <div class="d-flex align-items-center justify-content-center">
            <picture style="height: 40px;" class="d-inline-block">
                <source srcset="{{ asset('images/logo.webp') }}" type="image/webp">
                <source srcset="{{ asset('images/logo.png') }}" type="image/png">
                <img src="{{ asset('images/logo.png') }}" alt="Cel's Group" height="40">
            </picture>
        </div>
        <hr class="my-4" />
        {{ __('Please enter the e-mail you use to login.') }}

        <form method="POST" action="{{ route('password.email') }}" class="mt-2">
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

            <hr class="mb-4" />

            <div class="form-group mb-1">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection