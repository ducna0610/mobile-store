@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row profile">
            <div class="col-md-3 mb-3 summary">
                <b>Thống kê</b>
                <br>
                <div class="my-4 row">
                    <div class="col">
                        <a href="{{ route('bills.showBill') }}" style="text-decoration: none">Số đơn hàng</a>:
                        {{ $num_order }}
                    </div>
                </div>
                <div class="my-4 row">
                    <div class="col">
                        Đơn chờ lấy: 40
                    </div>
                </div>
                <div class="my-4 row">
                    <div class="col">
                        Số đơn: 40
                    </div>
                </div>
            </div>
            <div class="col-md-9 mb-3">
                <b>Thông tin cá nhân</b>

                <form method="post" action="{{ route('users.editProfile') }}" autocomplete="off">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-4 row">
                            <label for="inputName" class="col-sm-3 col-form-label">Tên (*)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputName" required
                                    value="{{ $user->name }}" name="name">
                                @error('name')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-sm-3 col-form-label">Giới tính</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required value="1" name="gender"
                                        id="male" @checked($user->gender == 1)>
                                    <label class="form-check-label" for="male">
                                        Nam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" required value="0" name="gender"
                                        id="female" @checked($user->gender == 0)>
                                    <label class="form-check-label" for="female">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="date" class="col-sm-3 col-form-label">Ngày sinh</label>
                            <div class="col-sm-9">
                                <input type="text" id="date" name="dob" value="{{ $user->dob }}" />
                                @error('dob')
                                    <br>
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="inputPhone" class="col-sm-3 col-form-label">Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPhone" value="{{ $user->phone }}"
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
                            <input type="text" class="form-control" id="inputAddress" value="{{ $user->address }}"
                                name="address">
                            @error('address')
                                <span style='color: red;'>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <div class="btn btn-primary" data-bs-target="#modalToggleLogin" data-bs-toggle="modal"
                            data-bs-dismiss="modal">Đổi mật khẩu</div>
                        <button class="btn btn-info">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('user/css/tiny-date-picker.css') }}">
    <style>
        .profile {
            margin: 40px 12px;
            padding: 20px;
            background-color: #ffff;
            border-radius: 12px;
        }

        .summary {
            border-right: 4px solid gray;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('user/js/tiny-date-picker.min.js') }}"></script>
    <script src="{{ asset('user/js/moment.min.js') }}"></script>
    <script>
        var dpBelow = TinyDatePicker('#date', {
            mode: 'dp-modal',
            lang: {
                days: ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'],
                months: [
                    'Tháng 1',
                    'Tháng 2',
                    'Tháng 3',
                    'Tháng 4',
                    'Tháng 5',
                    'Tháng 6',
                    'Tháng 7',
                    'Tháng 8',
                    'Tháng 9',
                    'Tháng 10',
                    'Tháng 11',
                    'Tháng 12',
                ],
                today: 'Hôm nay',
                clear: 'Xóa',
                close: 'Đóng',
            },
            format(date) {
                return moment(date).format('DD-MM-YYYY');
            },
            max: moment(),
        });
    </script>
@endpush
