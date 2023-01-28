@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admins.manufacturers.create') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Thêm mới</b>
                            </a>
                            <a href="{{ route('admins.manufacturers.create') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Thống kê</b>
                            </a>
                            <a href="{{ route('admins.products.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Sản phẩm</b>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <p class="category">Tìm kiếm tên, email, số điện thoại nsx</p>
                    <form class="form-horizontal" id="form-search">
                        <div class="row">
                            <div class="col-xs-6 col-md-4" style="padding-bottom: 8px">
                                <input type="search" class="form-control input-search" placeholder="Tim kiem..."
                                    name="keywords" value="{{ request()->get('keywords') }}">
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
                                    <th width="15%">
                                        <b>Tên</b>
                                        <a href="?sort-by=name&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=name&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="10%" class="text-left"><b>Logo</b></th>
                                    <th width="15%"><b>Số điện thoại</b></th>
                                    <th width="20%">
                                        <b>Email</b>
                                        <a href="?sort-by=email&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=email&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="14%">
                                        <b>Địa chỉ</b>
                                        <a href="?sort-by=address&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=address&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="20%" class="text-center">
                                        <b>Số sản phẩm</b>
                                        <a href="?sort-by=quantity&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=quantity&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="1%" class="text-center"><b>Hành động</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td width="5%">{{ $item->id }}</td>
                                        <td width="15%">{{ $item->name }}</td>
                                        {{-- 800 x 500 --}}
                                        <td width="10%"><img src="{{ asset('storage/' . $item->logo) }}" rel="tooltip"
                                                title="{{ $item->name }}"></td>
                                        <td width="15%">
                                            <a href="tel:{{ $item->phone }}">
                                                {{ $item->phone }}
                                            </a>
                                        </td>
                                        <td width="20%">
                                            <a href="mailto:{{ $item->email }}">
                                                {{ $item->email }}
                                            </a>
                                        </td>
                                        <td width="14%">{{ $item->address }}</td>
                                        <td width="20%" class="text-center">100</td>
                                        <td width="1%" class="td-actions text-center col-xs-3">
                                            <a href="" rel="tooltip" title="Chi tiết"
                                                class="btn-lg col-md-4 col-xs-12">
                                                <i class="ti-info-alt"></i>
                                            </a>
                                            <a href="{{ route('admins.manufacturers.edit', $item->id) }}" rel="tooltip"
                                                title="Chỉnh sửa" style="color: green" class="btn-lg col-md-4 col-xs-12">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <form id="form-delete"
                                                action="{{ route('admins.manufacturers.destroy', $item->id) }} "method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a onclick="if(confirm('Are u sure?')) {
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
            $(".input-search").change(function() {
                $('#form-search').submit();
            });
        });
    </script>
@endpush
