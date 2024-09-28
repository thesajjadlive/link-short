<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.frontend.head')
</head>
<body>
    
<!-- header start -->
@include('layouts.frontend.header')

<!-- navbar start -->
@include('layouts.frontend.navbar')
<!-- main content start -->
 @yield('content')
<!-- footer start -->
@include('layouts.frontend.footer')
</body>
</html>
