<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(session('success_message'))
        <meta name="session-message" data-status="success" content="{{ session('success_message') }}">
    @endif
    @if(session('error_message'))
        <meta name="session-message" data-status="error" content="{{ session('success_error') }}">
    @endif

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- I-check Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{asset("AdminLTE/plugins/fontawesome_6_4_2/css/all.min.css")}}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{asset("AdminLTE/dist/css/adminlte.min.css")}}>
    <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/custom.css") }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
    @vite('resources/scss/aspect-ratio.scss')
    @vite('resources/js/admin.js')
    @stack('iframe.style')
</head>

<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">


    @yield('admin.content')

    <!-- jQuery -->
    <script src={{asset("AdminLTE/plugins/jquery/jquery.min.js")}}></script>

    <!-- Bootstrap 4 -->
    <script src={{ asset("AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>

    <!-- AdminLTE App -->
    <script src={{asset("AdminLTE/dist/js/adminlte.min.js")}}></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetAlertSession.js') }}"></script>
    @stack('iframe.script')

</body>
</html>

