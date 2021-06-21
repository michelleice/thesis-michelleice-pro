@extends('auth.layouts.master')

@section('content')
@if (session('resent'))
<div class="alert alert-success" role="alert">
    {{ __('A fresh verification link has been sent to your email address.') }}
</div>
@endif

<div class="card rounded-lg border-0 text-black">
    <div class="card-body px-4">
        <div class="d-flex align-items-center justify-content-center">
            <h4 class="d-inline-block display-4 mb-0 text-dark">{{ config('app.name') }}</h4>
        </div>
        <hr class="my-4" />
        <div class="text-muted mb-3">Verify your E-mail Address</div>
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>
</div>
@endsection
