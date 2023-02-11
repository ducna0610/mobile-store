<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{ $title }} - {{ config('app.name') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('admin/css/paper-dashboard.css') }}" rel="stylesheet" />

    {{-- Config CSS --}}
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('admin/css/themify-icons.css') }}" rel="stylesheet">

    <style>
        a {
            cursor: pointer;
        }
    </style>
    @stack('css')
</head>

<body class="sidebar-mini">
    <div class="wrapper">
        {{-- sidebar --}}
        @include('admin.layouts.sidebar')

        <div class="main-panel">
            {{-- navbar --}}
            @include('admin.layouts.navbar')

            <div class="content">
                <div class="container-fluid">
                    {{-- content --}}
                    @yield('content')
                </div>
            </div>

            {{-- footer --}}
            @include('admin.layouts.footer')
        </div>
    </div>

    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="{{ asset('admin/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="{{ asset('admin/js/es6-promise-auto.min.js') }}"></script>

    <!--  Select Picker Plugin -->
    <script src="{{ asset('admin/js/bootstrap-selectpicker.js') }}"></script>

    <!--  Switch and Tags Input Plugins -->
    <script src="{{ asset('admin/js/bootstrap-switch-tags.js') }}"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="{{ asset('admin/js/sweetalert2.js') }}"></script>

    <!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
    <script src="{{ asset('admin/js/paper-dashboard.js') }}"></script>

    {{-- Notify --}}
    <script src="{{ asset('admin/js/notify.min.js') }}"></script>

    {{-- Alert --}}
    @if (session('success'))
        <script>
            swal('{{ session('success') }}', "OK!", "success");
        </script>
    @endif

    @if ($errors->any())
        <script>
            swal("Đã có lỗi xảy ra!", "Vui lòng thử lại!", "error");
        </script>
    @endif

    {{-- Config --}}
    <script src="{{ asset('admin/js/main.js') }}"></script>

    @stack('js')
</body>

</html>
