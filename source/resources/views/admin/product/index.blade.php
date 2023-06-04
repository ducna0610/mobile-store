@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admins.products.create') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Thêm mới</b>
                            </a>
                            <a href="{{ route('admins.manufacturers.create') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Thống kê</b>
                            </a>
                            <a href="{{ route('admins.manufacturers.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Nhà sản xuất</b>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <p class="category">Tìm kiếm tên sản phẩm, tên nhà sản xuất</p>
                    <form class="form-horizontal" method="GET">
                        <div class="row">
                            <div class="col-xs-6 col-md-4" style="padding-bottom: 8px">
                                <input type="search" class="form-control" placeholder="Tim kiem..." name="keywords"
                                    value="{{ request()->get('keywords') }}">
                            </div>
                            <div class="col-xs-6 col-md-2">
                                <select class="selectpicker" data-style="btn btn-primary btn-block" data-size="7"
                                    name="manufacturer_id">
                                    <option>Nhà sản xuất</option>
                                    @foreach ($manufacturers as $manufacturer)
                                        <option value="{{ $manufacturer->id }}"
                                            @if (request()->get('manufacturer_id') == $manufacturer->id) selected @endif>
                                            {{ $manufacturer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-4" style="padding-bottom: 8px">
                                <button type="submit" class="btn btn-primary btn-fill">
                                    Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-content table-responsive table-full-width">
                    @if (count($data))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%"><b>#</b></th>
                                    <th width="20%">
                                        <b>Tên</b>
                                        <a href="?sort-by=name&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=name&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="15%"><b>Ảnh</b></th>
                                    <th width="20%">
                                        <b>Nhà sản xuất</b>
                                        <a href="?sort-by=email&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=email&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="25%">
                                        <b>Trạng thái</b>
                                    </th>
                                    <th width="15%">
                                        <b>Số lượng</b>
                                        <a href="?sort-by=email&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=email&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="1%" class="text-center"><b>Hành động</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td width="5%">{{ $item->id }}
                                        </td>
                                        <td width="20%">{{ $item->name }}</td>
                                        {{-- 800 x 500 --}}
                                        <td width="15%">
                                            <a href="{{ route('admins.products.detail', $item->id) }}">
                                                <img src="{{ asset($item->image) }}" rel="tooltip"
                                                    title="{{ $item->name }}">
                                            </a>
                                        </td>
                                        <td width="20%">{{ $item->manufacturer->name }}</td>
                                        <td width="25%">
                                            <input type="checkbox" class="switch" data-active={{ $item->active }}
                                                data-id={{ $item->id }}
                                                @if ($item->active) checked @endif>
                                        </td>
                                        <td width="15%">{{ $item->types_sum_quantity }}</td>
                                        <td width="1%" class="td-actions text-center col-xs-3">
                                            <a href="{{ route('admins.products.detail', $item->id) }}" rel="tooltip"
                                                title="Chi tiết" class="btn-lg col-md-4 col-xs-12">
                                                <i class="ti-info-alt"></i>
                                            </a>
                                            <a href="{{ route('admins.products.edit', $item->id) }}" rel="tooltip"
                                                title="Chỉnh sửa" style="color: green" class="btn-lg col-md-4 col-xs-12">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <form id="form-delete"
                                                action="{{ route('admins.products.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#"
                                                    onclick="if(confirm('Are u sure?')) {
                                                    document.getElementById('form-delete').submit()
                                                };"
                                                    rel="tooltip" title="Xóa" type="submit" style="color: red"
                                                    class="btn-lg col-md-4 col-xs-12">
                                                    <i class="ti-close"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(".switch").siblings().click(function() {

                let active = $(this).siblings('input')[0].checked;
                let id = $(this).siblings('input').data('id');

                $.ajax({
                    type: "POST",
                    url: "{{ url('ad/products/update-active') }}/" + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        active
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        if (response == 1) {
                            $.notify("Cập nhật trạng thái thành công.", "success");
                        } else {
                            $.notify("Cập nhật trạng thất bại.", "error");
                        }
                    }
                });
            });
        });
    </script>
@endpush
