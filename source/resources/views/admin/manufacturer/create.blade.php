@extends('admin.layouts.master')

@section('content')
    <div class="card">
        <form class="form-horizontal" action="{{ route('admins.manufacturers.store') }}" method="POST"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="card-header">
                <h4 class="card-title">
                    {{ $title }}
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="name">Tên nhà sản xuất</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập tên nsx" class="form-control" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="fileinput">
                        <i class="fa fa-cloud-upload"></i> Logo
                    </label>
                    <div class="col-md-6">
                        <input type="file" id="fileinput" style="height:0;overflow:hidden; padding-top: 8px"
                            name="logo" accept=".png, .jpg" required>
                        <button id="addImage" type="button">Upload image</button>
                        <div class="preview"></div>
                        @error('logo')
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
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <label class="col-md-3"></label>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info">
                            Thêm
                        </button>
                        <a href="{{ route('admins.manufacturers.index') }}" class="btn btn-warning">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end card -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#addImage").click(function() {
                $("#fileinput").click();
            });

            $("#fileinput").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });

            function imageIsLoaded(e) {
                var x = 'foo';
                var picture = '<img src="' + e.target.result +
                    '" style="width:220px;height:48px; margin-top: 12px;" class="' + x +
                    'thImage">'
                $(".preview").empty().append(picture);
            }

        });
    </script>
@endpush
