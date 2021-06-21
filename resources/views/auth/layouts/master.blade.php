@extends('layouts.html')

@section('body')
<div class="min-vw-100 bg-light d-flex align-items-center py-4" style="min-height: 100vh;">
    <div class="min-vw-100 h-100 d-flex align-items-center">
        <div class="container p-0 d-flex w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
@endpush
