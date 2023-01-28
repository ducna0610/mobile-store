@extends('admin.layouts.master')

@section('content')
    <div class="card">
        <form class="form-horizontal" action="{{ route('admins.types.update', $type->id) }}" method="post"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4 class="card-title">
                    {{ $title }}
                    <b>
                        {{ $type->product->name }}
                    </b>
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="color">Màu</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập màu sản phẩm" class="form-control" id="color"
                            name="color" value="{{ $type->color }}">
                        @error('color')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="disk">Dung lượng bộ nhớ</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập bộ nhớ sản phẩm" class="form-control"
                            id="disk" name="disk" value="{{ $type->disk }}">
                        @error('disk')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="ram">Ram</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập ram sản phẩm" class="form-control" id="ram"
                            name="ram" value="{{ $type->ram }}">
                        @error('ram')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="chip">Chip</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập chip sản phẩm" class="form-control" id="chip"
                            name="chip" value="{{ $type->chip }}">
                        @error('chip')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="pin">Pin</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập pin sản phẩm" class="form-control" id="pin"
                            name="pin" value="{{ $type->pin }}">
                        @error('pin')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="quantity">Số lượng</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập số lượng sản phẩm" class="form-control"
                            id="quantity" name="quantity" value="{{ $type->quantity }}">
                        @error('quantity')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="price">Giá (vnđ)</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập giá sản phẩm" class="form-control" id="price"
                            name="price" value="{{ $type->price }}">
                        @error('price')
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
                            Cập nhật
                        </button>
                        <a href="{{ route('admins.products.detail', $type->product()->first('id')->id) }}"
                            class="btn btn-warning">
                            Quay
                            lại
                        </a>
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
                    '" style="width:200px; margin-top: 12px;" class="' + x +
                    'thImage">'
                $(".preview").empty().append(picture);
            }

        });
    </script>
@endpush
