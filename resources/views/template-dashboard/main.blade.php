<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('nice-admin/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('nice-admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

  @stack('script')
</body>

</html>