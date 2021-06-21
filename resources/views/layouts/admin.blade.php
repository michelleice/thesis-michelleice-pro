@extends('layouts.html', ['remove_scripts' => isset($remove_scripts) && $remove_scripts])

@section('body_class', 'sidebar-mini layout-fixed layout-navbar-fixed')
@section('body')
<div class="wrapper">
    <x-navbar />
    <x-sidebar />

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer text-sm bg-light">
        <strong>Copyright &copy; {{ \date('Y') }} <span class="text-ff-lilita">{{ config('app.name') }}</span>.</strong> All rights reserved.
    </footer>
</div>

<div class="position-fixed d-none" style="top: .5rem; z-index: 99999; max-width: 98vw; width: 480px; left: 1vw;" id="notification-permission-request">
    <div class="alert fade show mb-0 bg-white shadow" id="notification-permission-request-alert">
        <h6 class="font-weight-bold">
            @lang('Allow notifications?')
        </h6>
        <div>
            @lang('We\'d like to show you notifications for the latest updates').
        </div>
        <small class="text-muted">
            @lang('You can always change this setting on your preferences section in your profile at a later time').
        </small>
        <hr />
        <div class="text-right">
            <button class="btn btn-light" type="button" data-dismiss="alert" id="notification-request-later-button">
                Later
            </button>
            <button class="btn btn-primary" type="button" data-dismiss="alert" id="notification-request-allow-button">
                Allow
            </button>
        </div>
    </div>
</div>
@endsection

@prepend('styles')
<link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet" 
      integrity="sha512-pDpLmYKym2pnF0DNYDKxRnOk1wkM9fISpSOjt8kWFKQeDmBTjSnBZhTd41tXwh8+bRMoSaFsRnznZUiH9i3pxA==" crossorigin="anonymous" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.0/css/OverlayScrollbars.min.css" rel="stylesheet" 
      integrity="sha512-pYQcc5kgavar0ah58/O8hw/6Tbo3mWlmQTmvoi1i96cBz7jQYS9as5J+Nfy32rAHY6CgR9ExwnFMcBdGVcKM7g==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/3.18.1/tagify.min.css" 
      integrity="sha512-hqxNYuIWMQISqScYH0xQ3i8kH4MMxhJYlp7mfYvBGJKSGyliqk7SXRK3MxBuUnSwA1XeV+S+y3ad4oF+xD6kpA==" crossorigin="anonymous" />
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />

<link href="{{ asset('css/admin-custom.css') }}" rel="stylesheet" />
@endprepend

@if(isset($remove_scripts) && $remove_scripts)
@else
    @prepend('scripts')
    <script src="{{ asset('js/helpers/cels-globals-sw.js') }}"></script>

    <script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/lib/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.0/js/jquery.overlayScrollbars.min.js" 
            integrity="sha512-KltPgUHPHUvpLQvgtMveflxNopj998UE0fGQEGXQIKAA7b3SEJj2g832nnrxYDWGA5rbiF2mXX0lFE5Q37/03w==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js" 
            integrity="sha512-+cXPhsJzyjNGFm5zE+KPEX4Vr/1AbqCUuzAS8Cy5AfLEWm9+UI9OySleqLiSQOQ5Oa2UrzaeAOijhvV/M4apyQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/3.18.1/tagify.min.js" 
            integrity="sha512-JRIborxgq/oSqXznEejYTQy0vsL09n1RDmm3acR5o7fAmQkRbxgTr/yvROCijeoRSaBZHvR8CfsI6fCSG4X0pA==" crossorigin="anonymous"></script>

    <script src="{{ asset('js/adminlte.js') }}"></script>

    <script src="{{ asset('js/helpers/cels-summernote.js') }}"></script>

    <script src="{{ asset('js/helpers/datatables.js') }}"></script>
    @endprepend
@endif