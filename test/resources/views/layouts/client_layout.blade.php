<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Shortly - @yield('title')</title>
    <meta name="description" content="">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Including header scripts & css -->
    @include('partials.client.ui.head_scripts')
    
    <!-- Yield CSS -->
    @yield('css')

</head>

<body>

    <div class="wrapper">
        <div class="page-overlay"></div>
        <!-- Including Navbar -->
        @include('partials.client.ui.navbar')

        <!-- Yield Content -->
        @yield('content')

        <!-- Including footer section -->
        @include('partials.client.ui.footer')

        <!-- Including footer scripts -->
        @include('partials.client.ui.footer_scripts')

        <!--- Yield JS -->
        @yield('js')
    </div>

</body>
</html>