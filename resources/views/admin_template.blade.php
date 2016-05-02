<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    @include('_head')
<body class="skin-blue">
<div class="wrapper">

    <!-- Header -->
    @include('_header')

    <!-- Sidebar -->
    @include('_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<!--             <h1>
                {{ $page_title or "Page Title" }}
                <small>{{ $page_description or null }}</small>
            </h1> -->

            @yield('flash_messages')
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('_footer')

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

@include('_scripts')

</body>
</html>
