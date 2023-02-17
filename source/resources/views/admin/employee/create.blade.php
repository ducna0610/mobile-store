@extends('admin.layouts.master')

@section('content')
    <div class="card">
        <form class="form-horizontal" action="{{ route('admins.employees.store') }}" method="POST"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="card-header">
                <h4 class="card-title">
                    {{ $title }}
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="name">Tên nhân viên</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập tên nhân viên" class="form-control" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="email">Email</label>
                    <div class="col-md-6">
                        <input required type="email" placeholder="Nhập email nsx" class="form-control" id="email"
                            name="email" value="{{ old('email') }}">
                        @error('email')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Giới tính</label>
                    <div class="col-md-6">

                        <div class="radio">
                            <input type="radio" name="gender" id="male" value="1" checked="">
                            <label for="male">
                                Nam
                            </label>
                        </div>

                        <div class="radio">
                            <input type="radio" name="gender" id="female" value="0">
                            <label for="female">
                                Nữ
                            </label>
                        </div>
                    </div>
                    @error('gender')
                        <span style='color: red;'>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="dob">Ngày sinh</label>
                    <div class="col-md-6">
                        <input required type="date" class="form-control" id="dob" name="dob">
                        @error('dob')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="phone">Số điện thoại</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập số điện thoại nsx" class="form-control"
                            id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="address">Địa chỉ</label>
                    <div class="col-md-6">
                        <textarea required class="form-control" placeholder="Nhập địa chỉ nsx" rows="3" id="address" name="address">{{ old('address') }}</textarea>
                        @error('address')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="password">Mật khẩu</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập mật khẩu" class="form-control" id="password"
                            name="password" value="{{ old('password') }}">
                        @error('password')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <label class="col-md-3"></label>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info">
                            Thêm
                        </button>
                        <a href="{{ route('admins.employees.index') }}" class="btn btn-warning">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end card -->
@endsection
