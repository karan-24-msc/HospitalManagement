<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>@yield('title') - ABC Hospital Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    @include('admin.layouts.partials.head')

    @stack('admin_styles')

</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    @include('admin.layouts.partials.topbar')
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    @include('admin.layouts.partials.sidebar')
    <!-- Left Sidebar End -->

    <!-- Start right Content here -->

    <div class="content-page">
        @yield('admin_content')

        <footer class="footer">
            2016 - 2020 © Xadmino.
        </footer>
    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->

<!-- jQuery  -->

@stack('admin_scripts')
@include('admin.layouts.partials.foot')

</body>

</html>
