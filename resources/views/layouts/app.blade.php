<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Invoicing Management System') }}</title>





    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <!-- Custom CSS -->
    {{--    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">--}}


    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/quill/dist/quill.snow.css') }}">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}">
    <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>





    <link rel="stylesheet" href="{{ asset('dist/css/icons/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/css/icons/material-design-iconic-font/css/materialdesignicons.min.css') }}">



</head>
<body>




    <div id="app">


    @include('header')

    {{--@yield('main')--}}


    @yield('content')

        <!-- Scripts -->
        {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
        <script  type="text/javascript" src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>



    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>--}}



    <!-- Bootstrap tether Core JavaScript -->
        <script  type="text/javascript" src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
        <script  type="text/javascript" src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script  type="text/javascript" src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
        <script  type="text/javascript" src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>

        <!--Wave Effects -->

        <script  type="text/javascript" src="{{ asset('dist/js/waves.js') }}"></script>

        <!--Menu sidebar -->
        <script  type="text/javascript" src="{{ asset('dist/js/sidebarmenu.js') }}"></script>


        <!--Custom JavaScript -->

        <script  type="text/javascript" src="{{ asset('dist/js/custom.min.js') }}"></script>

        <script  type="text/javascript" src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>


        <script  type="text/javascript" src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script  type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

        <script  type="text/javascript" src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
        <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>

        <script  type="text/javascript" src="{{ asset('js/main.js') }}" defer></script>



    </div>
</body>
</html>
