<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark static-top header">
    <div class="container">
        <a class="navbar-brand" href="{{ route('homes.index') }}">
            <img src="{{ asset('user/img/logo.png') }}" alt="..." height="40" style="border-radius: 50%;">
        </a>

        <form class="d-flex" style="width: 200px;">
            <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search"
                value="{{ request()->get('q') }}">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('homes.index') }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homes.about') }}">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        Giới thiệu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homes.location') }}">
                        <i class="fa fa-wrench" aria-hidden="true"></i>
                        Bảo hành
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bills.showBill') }}">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            Đơn hàng
                        </a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('carts.showCart') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        Giỏ hàng
                        <span class="badge rounded-pill bg-danger" id="total_quantity">
                        </span>
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" href="#modalToggleLogin">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" href="#modalToggleRegister">Register</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-lg fa-user-circle" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="header-nav-current-user">
                                <p role="menuitem" class="px-3 mb-n2 mt-n1 d-block">Xin chào
                                    <br>
                                    <strong>{{ auth()->user()->name }}</strong>
                                </p>
                            </li>
                            <div role="none" class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="{{ route('users.showProfile') }}">Thông tin cá nhân</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- form signing --}}
@guest
    {{-- modal login --}}
    <div class="modal fade" id="modalToggleLogin" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('logging') }}" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title">Login Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-4 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Email (*)</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="staticEmail" required
                                    value="{{ old('email') }}" name="email">
                                @error('email')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password (*)</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword" required name="password">
                                @error('password')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="container">
                            Đăng nhập bằng:
                            <div class="mb-6 row">
                                <a href="{{ route('auth.redirect', 'github') }}" class="link-secondary p-2 col-1">
                                    <i class="fa fa-github fa-2x" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('auth.redirect', 'google') }}" class="link-secondary p-2 col-1">
                                    <i class="fa fa-google fa-2x" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('auth.redirect', 'facebook') }}" class="link-secondary p-2 col-1">
                                    <i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn btn-primary" data-bs-target="#modalToggleRegister" data-bs-toggle="modal"
                            data-bs-dismiss="modal">Bạn chưa có tài khoản?</div>
                        <button class="btn btn-info">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal register --}}
    <div class="modal fade" id="modalToggleRegister" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('registering') }}" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title">Register Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-4 row">
                            <label for="inputName" class="col-sm-3 col-form-label">Tên (*)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" required
                                    value="{{ old('name') }}" name="name">
                                @error('name')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Email (*)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="staticEmail" required
                                    value="{{ old('email') }}" name="email">
                                @error('email')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-sm-3 col-form-label">Giới tính</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required value="1"
                                        name="gender" id="male" checked>
                                    <label class="form-check-label" for="male">
                                        Nam
                                    </label>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required value="0"
                                        name="gender" id="female">
                                    <label class="form-check-label" for="female">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="inputPhone" class="col-sm-3 col-form-label">Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPhone" value="{{ old('phone') }}"
                                    name="phone">
                                @error('phone')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="inputAddress" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ old('address') }}"
                                name="address">
                            @error('address')
                                <span style='color: red;'>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <p>Mật khẩu phải có ít nhất 8 kí tự bao gồm: </p>
                        <p> chữ cái hoa, thường, chữ số.</p>
                        <div class="mb-4 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Mật khẩu (*)</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputPassword" required name="password">
                                @error('password')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Nhập lại mật khẩu
                                (*)
                            </label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="inputConfirmPassword" required
                                    name="password_confirmation">
                            </div>
                        </div>
                        <hr>
                        <div class="container">
                            Liên kết tài khoản với:
                            <div class="mb-6 row">
                                <a href="{{ route('auth.redirect', 'github') }}" class="link-secondary p-2 col-1">
                                    <i class="fa fa-github fa-2x" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('auth.redirect', 'google') }}" class="link-secondary p-2 col-1">
                                    <i class="fa fa-google fa-2x" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('auth.redirect', 'facebook') }}" class="link-secondary p-2 col-1">
                                    <i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn btn-primary" data-bs-target="#modalToggleLogin" data-bs-toggle="modal"
                            data-bs-dismiss="modal">Bạn đã có tài khoản?</div>
                        <button class="btn btn-info">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endguest
