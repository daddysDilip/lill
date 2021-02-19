<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Shortly Admin Dashboard - @yield('title')</title>

    <!-- Including header scripts & css -->
    @include('partials.admin.ui.head_scripts')
    
    <!-- Yield CSS -->
    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    <!-- Including Navbar -->
    @include('partials.admin.ui.navbar')

    <!-- Yield Content -->
    @yield('content')

    <!-- Including footer section -->
    @include('partials.admin.ui.footer')

    <!-- Including footer scripts -->
    @include('partials.admin.ui.footer_scripts')

    <!--- Yield JS -->
    @yield('js')
    

  </body>
  <!-- END: Body-->

</html>