@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admins.products.edit', $product->id) }}"
                                style="padding: 20px; font-size: 20px; " class="col-sm-3 col-xs-12">
                                <b>Chỉnh sửa</b>
                            </a>
                            <a href="{{ route('admins.manufacturers.create') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-3 col-xs-12">
                                <b>Thống kê</b>
                            </a>
                            <a href="{{ route('admins.products.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-3 col-xs-12">
                                <b>Sản phẩm</b>
                            </a>
                            <a href="{{ route('admins.manufacturers.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-3 col-xs-12">
                                <b>Nhà sản xuất</b>
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-content table-responsive table-full-width">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%"><b>#</b></th>
                                <th width="20%">
                                    <b>Tên</b>
                                </th>
                                <th width="15%"><b>Ảnh</b></th>
                                <th width="20%">
                                    <b>Nhà sản xuất</b>
                                </th>
                                <th width="30%">
                                    <b>Mô tả</b>
                                </th>
                                <th width="1%" class="text-center"><b>Hành động</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="5%">{{ $product->id }}</td>
                                <td width="20%">{{ $product->name }}</td>
                                {{-- 600 x 600 --}}
                                <td width="15%">
                                    <img src="{{ asset($product->image) }}" rel="tooltip" title="{{ $product->name }}">
                                </td>
                                <td width="20%">{{ $product->manufacturer->name }}</td>
                                <td width="30%">{{ $product->description }}</td>
                                <td width="1%" class="td-actions text-center col-xs-3">
                                    <a href="{{ route('admins.products.edit', $product->id) }}" rel="tooltip"
                                        title="Chỉnh sửa" style="color: green" class="btn-lg col-md-4 col-xs-12">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <a onclick="return confirm('Are u sure?')"
                                        href="{{ route('admins.products.destroy', $product->id) }}" rel="tooltip"
                                        title="Xóa" style="color: red" class="btn-lg col-md-4 col-xs-12">
                                        <i class="ti-close"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Cấu hình chi tiết --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cấu hình chi tiết</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTypeModal"
                        style="margin-top: 20px;">
                        Thêm cấu hình
                    </button>
                </div>
                <div class="card-content table-responsive table-full-width">
                    @if (count($types))
                        <table class="table">
                            <form action="">
                                <thead>
                                    <tr>
                                        <th width="5%"><b>#</b></th>
                                        <th width="10%"><b>Màu</b></th>
                                        <th width="10%"><b>Ram</b></th>
                                        <th width="15%"><b>Pin</b></th>
                                        <th width="15%"><b>Bộ nhớ</b></th>
                                        <th width="15%"><b>Chip</b></th>
                                        <th width="15%"><b>Số lượng</b></th>
                                        <th width="20%"><b>Giá</b></th>
                                        <th width="1%" class="text-center"><b>Hành động</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $key => $type)
                                        <tr>
                                            <td width="5%">{{ $key + 1 }}</td>
                                            <td width="10%">{{ $type->color }}</td>
                                            <td width="10%">{{ $type->ram }}</td>
                                            <td width="15%">{{ $type->pin }}</td>
                                            <td width="15%">{{ $type->disk }}</td>
                                            <td width="15%">{{ $type->chip }}</td>
                                            <td width="15%">{{ $type->quantity }}</td>
                                            <td width="20%">{{ $type->price }}</td>
                                            <td width="1%" class="td-actions text-center col-xs-3">
                                                <a href="{{ route('admins.types.edit', $type->id) }}" rel="tooltip"
                                                    title="Chỉnh sửa" style="color: green"
                                                    class="btn-lg col-md-4 col-xs-12">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <form id="form-delete-{{ $type->id }}"
                                                    action="{{ route('admins.types.destroy', $type->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <form id="form-delete-{{ $type->id }}"
                                                    action="{{ route('admins.types.destroy', $type->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a onclick="if(confirm('Are u sure?')) {
                                                    document.getElementById('form-delete-{{ $type->id }}').submit();
                                            };"
                                                    rel="tooltip" title="Xóa" style="color: red"
                                                    class="btn-lg col-md-4 col-xs-12">
                                                    <i class="ti-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </form>
                        </table>
                    @else
                        <div class="text-center" style="padding-top: 40px; font-size: 20px;">
                            <td class="col-xs-12">Không có dữ liệu</td>
                        </div>
                    @endif
                </div>
            </div>
            {{-- paginate --}}
            <div>
                {{ $types->links() }}
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTypeModalLabel">Thêm cấu hình</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="{{ route('admins.types.store', $product->id) }}"
                            method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="modal-body">
                                @csrf
                                <div class="card-content">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="disk">Dung lượng bộ nhớ</label>
                                        <div class="col-md-6">
                                            <input required type="text" placeholder="Nhập bộ nhớ sản phẩm"
                                                class="form-control" id="disk" name="disk"
                                                value="{{ $types[0]->disk ?? old('disk') }}">
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
                                            <input required type="text" placeholder="Nhập ram sản phẩm"
                                                class="form-control" id="ram" name="ram"
                                                value="{{ $types[0]->ram ?? old('ram') }}">
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
                                            <input required type="text" placeholder="Nhập chip sản phẩm"
                                                class="form-control" id="chip" name="chip"
                                                value="{{ $types[0]->chip ?? old('chip') }}">
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
                                            <input required type="text" placeholder="Nhập pin sản phẩm"
                                                class="form-control" id="pin" name="pin"
                                                value="{{ $types[0]->pin ?? old('pin') }}">
                                            @error('pin')
                                                <span style='color: red;'>
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="price">Giá (vnđ)</label>
                                        <div class="col-md-6">
                                            <input required type="text" placeholder="Nhập giá sản phẩm"
                                                class="form-control" id="price" name="price"
                                                value="{{ old('price') }}">
                                            @error('price')
                                                <span style='color: red;'>
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="colors">Màu</label>
                                    <div class="col-md-6">
                                        <input id="colors" type="text" placeholder="Nhập màu sản phẩm"
                                            class="tagsinput form-control" data-role="tagsinput" data-color="success"
                                            name="colors[]" required />
                                        @error('colors')
                                            <span style='color: red;'>
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ảnh minh họa --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ảnh minh họa</h4>
        </div>
        <div class="card-content table-responsive table-full-width">
            <div class="container lst">
                @if (!empty($list_images))
                    <form method="post" action="{{ route('admins.products.images.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('admins.products.images.store', $product->id) }}"
                            enctype="multipart/form-data">
                @endif
                @csrf
                <div class="input-group hdtuto control-group lst increment">
                    <div class="list-input-hidden-upload">
                        <input type="file" name="image_names[]" id="file_upload" class="myfrm form-control hidden">
                    </div>
                    <button class="btn btn-success btn-add-image" type="button">
                        <i class="fldemo glyphicon glyphicon-plus"></i>+Thêm ảnh
                    </button>
                </div>
                <div class="list-images">
                    @if (isset($list_images) && !empty($list_images))
                        @foreach (json_decode($list_images) as $key => $img)
                            <div class="box-image">
                                <input type="hidden" name="images_uploaded[]" value="{{ $img }}"
                                    id="img-{{ $key }}">
                                <img src="{{ asset('images/' . $img) }}" class="picture-box">
                                <div class="wrap-btn-delete"><span data-id="img-{{ $key }}"
                                        class="btn-delete-image">x</span></div>
                            </div>
                        @endforeach
                        <input type="hidden" name="images_uploaded_origin" value="{{ $list_images }}">
                        <input type="hidden" name="id" value="{{ $image_id }}">
                    @endif
                </div>
                <div class="button-submit">
                    <button type="submit" class="btn btn-success" style="margin-top:10px">
                        @if (!empty($list_images))
                            Cập nhật
                        @else
                            Lưu
                        @endif
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .list-images {
            width: 50%;
            margin-top: 20px;
            display: inline-block;
        }

        .hidden {
            display: none;
        }

        .box-image {
            width: 120px;
            height: 108px;
            position: relative;
            float: left;
            margin-left: 5px;
        }

        .box-image img {
            width: 120px;
            height: 80px;
        }

        .wrap-btn-delete {
            position: absolute;
            top: -8px;
            right: 0;
            height: 2px;
            font-size: 20px;
            font-weight: bold;
            color: red;
        }

        .btn-delete-image {
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-add-image").click(function() {
                $('#file_upload').trigger('click');
            });

            $('.list-input-hidden-upload').on('change', '#file_upload', function(event) {
                let today = new Date();
                let time = today.getTime();
                let image = event.target.files[0];
                let file_name = event.target.files[0].name;
                let box_image = $('<div class="box-image"></div>');
                box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
                box_image.append('<div class="wrap-btn-delete"><span data-id=' + time +
                    ' class="btn-delete-image">x</span></div>');
                $(".list-images").append(box_image);

                $(this).removeAttr('id');
                $(this).attr('id', time);
                let input_type_file =
                    '<input type="file" name="image_names[]" id="file_upload" class="myfrm form-control hidden">';
                $('.list-input-hidden-upload').append(input_type_file);
            });

            $(".list-images").on('click', '.btn-delete-image', function() {
                let id = $(this).data('id');
                $('#' + id).remove();
                $(this).parents('.box-image').remove();
            });
        });
    </script>
@endpush
