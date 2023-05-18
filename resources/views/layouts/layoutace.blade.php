<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('html.head');
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
@include('html.mobile')
<!-- Humberger End -->

<!-- Header Section Begin -->
@include('html.header')
<!-- Header Section End -->

<!-- Hero Section Begin -->
@include('html.departments')
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
@include('html.breadcrumb')
<!-- Breadcrumb Section End -->

@yield('main')

<!-- Footer Section Begin -->
@include('html.footer')
<!-- Footer Section End -->

<!-- Js Plugins -->
@include('html.scripts')

</body>

</html>
