<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title-prefix'){{ config('app.name') }}@yield('title-postfix')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="@yield('meta-keywords', config('app.name'))" name="keywords">
    <meta content="@yield('meta-description', config('app.name'))" name="description">

    <meta property="og:title" content="@yield('opengraph-title-prefix'){{ config('app.name') }}@yield('opengraph-title-postfix')">
    <meta property="og:type" content="company">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="@yield('opengraph-image', asset('images/logo.png'))">

    @auth
    <meta name="api-key" content="{{ Auth::user()->{Auth::user()->getAPIKeyName()} }}">
    @endauth
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-path" content="{{ secure_url(route('api.index', [], false)) }}">
    {{-- <meta name="api-path" content="{{ route('api.index') }}"> --}}

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon-apple-touch.ico') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;700&family=Baloo+2&family=Lilita+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&family=PT+Sans&display=swap" rel="stylesheet" defer />

    @stack('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" defer />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet" defer />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" defer />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" rel="stylesheet" defer />
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet" defer />

    @if(isset($remove_scripts) && $remove_scripts)
    @else
    <script src="https://kit.fontawesome.com/255e4d841e.js" crossorigin="anonymous" defer></script>
    @endif
</head>

<body class="@yield('body_class', '')">
    @yield('body')

    @if(isset($remove_scripts) && $remove_scripts)
    @else
    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
    
    <script src="{{ asset('js/easing.js') }}"></script>
    
    <script src="{{ asset('js/helpers/cels-animatecss.js') }}"></script>

    <script src="{{ asset('js/helpers/cels-globals.js') }}"></script>
    <script src="{{ asset('js/helpers/cels-request.js') }}"></script>
    <script src="{{ asset('js/helpers/cels-bootstrap4.js') }}"></script>
    <script src="{{ asset('js/helpers/toastr.js') }}"></script>
    
    @stack('scripts')

    <script src="{{ asset('js/helpers/tooltips.js') }}"></script>

    @if ($toast = session('toast'))
<script>
(() => {
    toastr["{{ $toast['type'] ?? 'success' }}"]("{!! $toast['content'] !!}", "{{ $toast['title'] ?? '' }}")
})();
</script>
    @endif
    @endif
</body>

</html>
