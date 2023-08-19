<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Libraray-Management') }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- slick part start -->

    <!-- <link rel="stylesheet" href="asset{asset('assets/libs/ion-rangeslider/css/ion.rangeSlider.min.css')}"
           type="text/css">  -->
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/style.css') }}">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/card.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}"> --}}
    <!-- preloder css -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link href="{{ asset('assets/libs/ion-rangeslider/css/ion.rangeSlider.min.css') }}" />
    <!-- Ion Range Slider-->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
</head>

<body>
    <div>
        @include('admin.sidebar')
    </div>

    <div>
        @include('admin.header')
    </div>


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid p-0">
                @yield('text')
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('assets/js/pages/product-filter-range.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('js/my.js') }}"></script>


</body>

</html>
