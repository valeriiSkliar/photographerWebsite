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

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{asset("AdminLTE/plugins/fontawesome-free/css/all.min.css")}}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{asset("AdminLTE/dist/css/adminlte.min.css")}}>
    <link rel="stylesheet" href={{asset("AdminLTE/plugins/daterangepicker/daterangepicker.css")}}>
    <link rel="stylesheet" href={{asset("AdminLTE/plugins/summernote/summernote-bs4.min.css")}}>
    <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/custom.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{asset("AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css') }}">
    @vite('resources/js/admin.js')
    @stack('iframe.style')
</head>

<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">


    @yield('admin.content')

    <!-- jQuery -->
    <script src={{asset("AdminLTE/plugins/jquery/jquery.min.js")}}></script>
    <!-- jQuery UI 1.11.4 -->
    <script src={{asset("AdminLTE/plugins/jquery-ui/jquery-ui.min.js")}}></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src={{ asset("AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
    <!-- overlayScrollbars -->
    <script src={{asset("AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
    <!-- AdminLTE App -->
    <script src={{asset("AdminLTE/dist/js/adminlte.js")}}></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('sweetalert/sweetAlertSession.js') }}"></script>
    @stack('iframe.script')

</body>
</html>

