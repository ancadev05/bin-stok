<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="kaiadmin/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('kaiadmin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('kaiadmin/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('kaiadmin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('kaiadmin/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('kaiadmin/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{-- <link rel="stylesheet" href="kaiadmin/css/demo.css" /> --}}
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('components.layouts.components.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            {{-- header --}}
            @include('components.layouts.components.header')
            {{-- /header --}}

            <div class="container">
                <div class="page-inner">

                    {{ $slot }}

                </div>
            </div>

            {{-- footer --}}
            {{-- @include('components.layouts.components.footer') --}}
            {{-- /footer --}}
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('kaiadmin/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('kaiadmin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('kaiadmin/js/core/bootstrap.min.js') }}"></script>



    <!-- jQuery Scrollbar -->
    <script src="{{ asset('kaiadmin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('kaiadmin/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('kaiadmin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('kaiadmin/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('kaiadmin/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('kaiadmin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('kaiadmin/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('kaiadmin/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{ asset('kaiadmin/js/plugin/gmaps/gmaps.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('kaiadmin/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('kaiadmin/js/kaiadmin.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable();
        })
    </script>
</body>

</html>
