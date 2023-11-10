<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <title>Leads</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- jQuery --}}
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    {{-- AcountingJS --}}
    <script src="{{ asset('assets/accountingJS/accounting.js') }}"></script>
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/dist/sweetalert2.min.css') }}">
    <script src="{{ asset('assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    {{-- DateRangePicker --}}
    <script src="{{ asset('assets/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/daterangepicker/daterangepicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/daterangepicker/daterangepicker.css') }}">
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}">
    {{-- SBAdmin --}}
    <link rel="stylesheet" href="{{ asset('assets/sbadmin/styles.css') }}">
    <script src="{{ asset('assets/sbadmin/scripts.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/custom-js-css/custom.css') }}">
    {{-- Architect UI --}}
    <link rel="stylesheet" href="{{ asset('assets/architect-ui/main_new.css') }}">
    <script src="{{ asset('assets/architect-ui/mainjs_new.js') }}"></script>

    @livewireStyles

</head>

<body>

    @extends('layouts.navbar')

    @section('navbar')
        @yield('content')
    @endsection
    
    @livewireScripts
    
</body>

</html>

