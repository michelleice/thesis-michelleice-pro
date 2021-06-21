<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-3 sidebar-light-primary" style="background-color: #f4f6f9;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-light">
        <img src="{{ asset('images/logo.png') }}" class="brand-image sidebar-shown-when-open ml-3 mr-3">
        <img src="{{ asset('images/favicon.png') }}" class="brand-image sidebar-shown-when-collapse ml-3 mr-3">
        <h4 class="display-4 mb-0 d-inline-block brand-text text-ff-lilita" style="font-size: 1.5rem;">
            {{ config('app.name') }}</h4>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <span class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset(Auth::user()->photo ?: 'images/default_user.png') }}" class="img-circle elevation-2"
                    alt="">
            </div>
            <div class="info">
                {{ Auth::user()->name }}
                @if (Auth::user()->is_administrator) <small class="d-block font-weight-bold text-muted text-truncate">Administrator</small> @endif
                <small class="d-block text-muted text-truncate">0 devices</small>
            </div>
        </span>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                @foreach ($navigations as $navigation)
                    <x-navigation-item :navigation="$navigation" />
                @endforeach
                <li class="nav-item d-block d-md-none mt-2">
                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                        @csrf
                        <button type="submit" class="nav-link btn btn-danger text-white w-100">@lang('Logout') <i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>