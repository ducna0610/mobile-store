@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admins.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Trang chủ</b>
                            </a>
                            <a href="{{ route('admins.manufacturers.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Nhà sản xuất</b>
                            </a>
                            <a href="{{ route('admins.products.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Sản phẩm</b>
                            </a>
                            <a href="{{ route('admins.orders.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Đơn hàng</b>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <form method="POST" class="col-md-8" style="font-size: 22px">
                            @csrf
                            Chức vụ:
                            <b>
                                @if (isSupperAdmin())
                                    Quản lí
                                @else
                                    Nhân viên
                                @endif
                            </b>
                            <br>
                            <br>
                            Họ tên:
                            <b>
                                {{ $user->name }}
                            </b>
                            <br>
                            <br>
                            Giới tính:
                            <b>
                                {{ $user->gender_name }}
                            </b>
                            <br>
                            <br>
                            Email:
                            <b>
                                {{ $user->email }}
                            </b>
                            <br>
                            <br>
                            Ngày sinh:
                            <b>
                                <input type="date" name="dob" value="{{ $user->dob }}">
                            </b>
                            @error('dob')
                                <span style='color: red;'>
                                    {{ $message }}
                                </span>
                            @enderror
                            <br>
                            <br>
                            Số điện thoại:
                            <b>
                                <input type="text" name="phone" value="{{ $user->phone }}">
                            </b>
                            @error('phone')
                                <span style='color: red;'>
                                    {{ $message }}
                                </span>
                            @enderror
                            <br>
                            Địa chỉ:
                            <b>
                                <input type="text" name="address" value="{{ $user->address }}">
                            </b>
                            @error('address')
                                <span style='color: red;'>
                                    {{ $message }}
                                </span>
                            @enderror
                            <button class="btn btn-info btn-fill btn-wd" style="margin: 40px">
                                Chỉnh sửa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
