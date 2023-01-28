<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mobile Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('user/css/main.css') }}">
    @stack('css')
</head>

<body style="padding-top:60px">
    {{-- navbar --}}
    @include('user.layouts.navbar')

    <div style="min-height: 85vh;">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.2)">
        <!-- Grid container -->
        <div class="container pt-2">
            <!-- Section: Social media -->
            <section class="mb-2">
                <!-- Facebook -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://www.facebook.com/ducna0610"
                    target="_blank" role="button" data-mdb-ripple-color="dark"><i class="fa fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://twitter.com/ducna0610"
                    role="button" target="_blank" data-mdb-ripple-color="dark"><i class="fa fa-twitter"></i></a>

                <!-- Instagram -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://www.instagram.com/duc.sw/"
                    role="button" target="_blank" data-mdb-ripple-color="dark"><i class="fa fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://www.linkedin.com/in/ducna0610/"
                    target="_blank" role="button" data-mdb-ripple-color="dark"><i class="fa fa-linkedin"></i></a>

                <!-- Github -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://github.com/ducna0610"
                    target="_blank" role="button" data-mdb-ripple-color="dark"><i class="fa fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->
        © {{ date('Y') }} Copyright:
        <a class="text-reset fw-bold" href="https://github.com/ducna0610" target="_blank">ducna0610</a>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"
        integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Notify --}}
    <script src="{{ asset('user/js/notify.min.js') }}"></script>

    {{-- Alert --}}
    @if (session('success'))
        <script>
            Swal.fire(
                '{{ session('success') }}',
                'Chúc bạn mua sắm vui vẻ.',
                'success'
            )
        </script>
    @endif

    @if (session('login'))
        <script>
            Swal.fire(
                '{{ session('login') }}',
                'Vui lòng đăng nhập để thực hiện thao tác.',
                'info'
            )
        </script>
    @endif

    @if ($errors->any() || session('error'))
        <script>
            Swal.fire(
                'Đã có lỗi xảy ra!',
                '{{ session('error') }} ' + 'Vui lòng thử lại!',
                'error'
            )
        </script>
    @endif

    <script src="{{ asset('user/js/main.js') }}"></script>

    <script>
        $.ajax({
            type: "GET",
            url: "{{ url('carts/total-quantity') }}",
            // data: "data",
            dataType: "json",
            success: function(response) {
                $('#total_quantity').empty();
                $('#total_quantity').append(response);
            }
        });
    </script>

    @stack('js')
</body>

</html>
