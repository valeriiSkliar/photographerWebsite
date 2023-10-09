<!DOCTYPE html>
<html lang="en">
@include('includes.admin.head')
<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
<div class="wrapper">
    <!-- Navbar -->
    @include('includes.admin.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('includes.admin.side_bar')
    <!-- Content Wrapper. Contains page content -->
    @include('includes.admin.content')
    <!-- /.content-wrapper -->
    @include('includes.admin.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('includes.admin.connected_js')
</body>
</html>
