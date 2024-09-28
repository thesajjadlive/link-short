<!DOCTYPE html>
<html lang="en">
<head>
 @include('layouts.partials.head')
</head>

<body class="fixed-navbar">
<div class="page-wrapper">
    <!-- START HEADER-->
    <header class="header">
        <div class="page-brand">
            <a class="link" target="_blank" href="{{ url('/') }}">
                    <span class="brand">
                        {{ config('app.name') }}
                    </span>
            </a>
        </div>
        <div class="flexbox flex-1">
            <!-- START TOP-LEFT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li>
                    <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                </li>
            </ul>
            <!-- END TOP-LEFT TOOLBAR-->
            <!-- START TOP-RIGHT TOOLBAR-->
            @include('layouts.partials.header')
            <!-- END TOP-RIGHT TOOLBAR-->
        </div>
    </header>
    <!-- END HEADER-->
    <!-- START SIDEBAR-->
        @include('layouts.partials.sidebar')
    <!-- END SIDEBAR-->
    <div class="content-wrapper">

          @yield('content')
        <!-- END PAGE CONTENT-->
        <footer class="page-footer">
            <div class="font-13">{{ date('Y') }} &copy; <b>Sajjad Hossain</b> - All rights reserved.</div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>
</div>

<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
@include('layouts.partials._script')
@include('vendor.lara-izitoast.toast')
</body>
</html>
