<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title', 'dashboard')</title>
    @include('backend.partials.style')

    <style>
        /* Fix pagination arrows size */
.pagination .page-item .page-link {
    font-size: 1rem;   /* adjust as needed */
    padding: 0.4rem 0.75rem; /* optional for proper spacing */
}

.pagination .page-item.disabled .page-link,
.pagination .page-item .page-link {
    line-height: 1.2;
}

/* Optional: if using icons inside arrows */
.pagination .page-item .page-link::before,
.pagination .page-item .page-link::after {
    font-size: 1rem;
}

    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @hasanyrole('super-admin|admin|writer')
    @include('backend.partials.header')
    @endhasanyrole
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @hasanyrole('super-admin|admin|writer')
    @include('backend.partials.sidebar')
    @endhasanyrole

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    {{-- <div class="sidenav-overlay"></div>
    <div class="drag-target"></div> --}}

    <!-- BEGIN: Footer-->
    @include('backend.partials.footer')
    <!--END: Footer-->
    @include('backend.partials.script')
</body>

</html>
<!-- END: Body-->