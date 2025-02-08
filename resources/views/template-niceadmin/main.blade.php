<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title ?? config('app.name')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo-biner.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo-biner.png') }}" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('nice-admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('nice-admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('nice-admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('nice-admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('nice-admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('nice-admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('nice-admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('nice-admin/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    {{-- select2 --}}
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">

    {{-- jquery --}}
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>

    @livewireStyles
    @stack('style')
</head>

<body>

    @include('template-dashboard.component.header')

    @include('template-dashboard.component.sidebar')



    <main id="main" class="main">

        @yield('content')
        {{ $slot }}

    </main><!-- End #main -->

    @include('template-dashboard.component.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @livewireScripts
    

    <!-- Vendor JS Files -->
    <script src="{{ asset('nice-admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('nice-admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('nice-admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('nice-admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('nice-admin/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('nice-admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('nice-admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('nice-admin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('nice-admin/assets/js/main.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

    {{-- <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script> --}}

    @stack('script')
</body>

</html>
