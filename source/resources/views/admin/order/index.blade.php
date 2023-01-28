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
                                <b>Thống kê</b>
                            </a>
                            <a href="{{ route('admins.products.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Sản phẩm</b>
                            </a>
                            <a href="{{ route('admins.manufacturers.index') }}" style="padding: 20px; font-size: 20px; "
                                class="col-sm-4 col-xs-12">
                                <b>Nhà sản xuất</b>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <p class="category">Tìm kiếm tên, email, số điện thoại</p>
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
                                    <th width="1%"><b>#</b></th>
                                    <th width="15%">
                                        <b>Người đặt</b>
                                        <a href="?sort-by=name&sort-type=desc"><i class="ti-arrow-down"></i></a>
                                        <a href="?sort-by=name&sort-type=asc"><i class="ti-arrow-up"></i></a>
                                    </th>
                                    <th width="15%" class="text-left"><b>Thời gian đặt</b></th>
                                    <th width="8%"><b>Người nhận</b></th>
                                    <th width="10%"><b>Số điện thoại</b></th>
                                    <th width="15%"><b>Địa chỉ</b></th>
                                    <th width="15%"><b>Tổng tiền</b></th>
                                    <th width="20%"><b>Trạng thái</b></th>
                                    <th width="1%" class="text-center"><b>Chi tiết</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td width="1%">{{ $item->id }}</td>
                                        <td width="5%">{{ $item->user()->first('name')->name }}</td>
                                        <td width="15%">{{ $item->created_at }}</td>
                                        <td width="8%">{{ $item->name_receiver }}</td>
                                        <td width="10%">{{ $item->phone_receiver }}</td>
                                        <td width="15%">{{ Str::limit($item->address_receiver, 40, '...') }}</td>
                                        <td width="15%">{{ $item->total_price }}</td>
                                        <td width="20%">
                                            <select class="selectpicker" data-id={{ $item->id }}
                                                data-style="btn
                                                btn-primary btn-block"
                                                data-size="7" name="manufacturer_id">
                                                @foreach ($status as $key => $val)
                                                    <option class="status" @selected($key === $item->status)>
                                                        {{ $val }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td width="1%">
                                            <a href="" rel="tooltip" title="Chi tiết" class="btn-lg">
                                                <i class="ti-info-alt"></i>
                                            </a>
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
            {{-- <div>
                {{ $data->links() }}
            </div> --}}
        </div>
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function() {
            $(".input-search").change(function() {
                $('#form-search').submit();
            });

            $('.status').click(function(e) {
                e.preventDefault();

                let status = $(this).parent('li').data('original-index');

                let id = $(this).closest('td').find('select').data('id');
                // console.log(id, status)

                $.ajax({
                    type: "POST",
                    url: "{{ url('ad/order/update-status') }}/" + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        if (response == 1) {
                            $.notify("Cập nhật trạng thái thành công.", "success");
                        } else {
                            $.notify("Cập nhật trạng thái thất bại.", "error");
                        }
                    }
                });

            });
        });
    </script>
@endpush
