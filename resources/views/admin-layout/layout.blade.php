<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('admin-html.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('admin-html.nav')
    <!-- /.navbar -->

    <!-- Header Section Begin -->
    @include('admin-html.header')
    <!-- Header Section End -->

    <!-- Main Sidebar Container -->
    @include('admin-html.sidebar')

    @yield('admin-main')

    <!-- Footer Section Begin -->
    @include('admin-html.footer')
    <!-- Footer Section End -->

    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
</div>
<!-- Js Plugins -->
@include('admin-html.scripts')

</body>

</html>
