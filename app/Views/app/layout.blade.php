<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ base_url('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ base_url('assets') }}/img/favicon.png">
    <title>
        {{$title??'Aplikasi Pemesanan Tiket Wisata'}}
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ base_url('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ base_url('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ base_url('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('style')
</head>

<body class="{{ $bodyClass ?? '' }}">

    @yield('content')

    <br><br><br><br><br>

    <script src="{{ base_url('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ base_url('assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ base_url('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ base_url('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
    @stack('js')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Initial Toast -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>

    <!-- Show alert using toast -->
    @if(session('success'))
    <script>
        Toast.fire({
            icon: 'success',
            title: "{{session('success')}}"
        })
    </script>
    @elseif(session('error'))
    <script>
        Toast.fire({
            icon: 'error',
            title: "{{session('error')}}"
        })
    </script>
    @elseif(session('info'))
    <script>
        Toast.fire({
            icon: 'info',
            title: "{{session('info')}}"
        })
    </script>
    @endif

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ base_url('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>