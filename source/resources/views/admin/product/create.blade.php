@extends('admin.layouts.master')

@section('content')
    <div class="card">
        <form class="form-horizontal" action="{{ route('admins.products.store') }}" method="POST" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="card-header">
                <h4 class="card-title">
                    {{ $title }}
                </h4>
            </div>
            <div class="card-content">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="name">Tên sản phẩm</label>
                    <div class="col-md-6">
                        <input required type="text" placeholder="Nhập tên sản phẩm" class="form-control" id="name"
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
                        <i class="fa fa-cloud-upload"></i> Ảnh
                    </label>
                    <div class="col-md-6">
                        <input type="file" id="fileinput" style="height:0;overflow:hidden; padding-top: 8px"
                            name="image" accept=".png, .jpg" required>
                        <button id="addImage" type="button">Upload image</button>
                        <div class="preview"></div>
                        @error('image')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="manufacturer">Nhà sản xuất</label>
                    <div class="col-md-3">
                        <select class="selectpicker" data-style="btn btn-primary btn-block" title="Nhà sản xuất"
                            data-size="7" name="manufacturer_id" required>
                            @foreach ($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                            @endforeach
                        </select>
                        @error('manufacturer_id')
                            <span style='color: red;'>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="description">Mô tả</label>
                    <div class="col-md-6">
                        <textarea required class="form-control" placeholder="Nhập mô tả sản phẩm" rows="10" id="description"
                            name="description">{{ old('description') }}</textarea>
                        @error('description')
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
                        <a href="{{ route('admins.products.index') }}" class="btn btn-warning">Quay lại</a>
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
                    '" style="width:200px;height:200px; margin-top: 12px;" class="' + x +
                    'thImage">'
                $(".preview").empty().append(picture);
            }

        });
    </script>
@endpush

@if ($errors->any())
    @push('script')
        <script>
            swal("Đã có lỗi xảy ra!", "Vui lòng thử lại!", "error");
        </script>
    @endpush
@endif
