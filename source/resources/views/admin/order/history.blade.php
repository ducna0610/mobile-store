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
                </div>
                <div class="card-content table-responsive table-full-width">
                    @if (count($data))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="25%" class="text-center"><b>Người duyệt</b></th>
                                    <th width="25%" class="text-center">
                                        <form action="" id="form-bill_id">
                                            <b>Mã đơn hàng</b>
                                            <select name="bill_id" id="select-bill_id">
                                                <option value=>Tất cả</option>
                                                @foreach ($arr_bill_id as $item)
                                                    <option @selected(request()->get('bill_id') == $item)>{{ $item }}</option>
                                                @endforeach
                                        </form>
                                        </select>
                                    </th>
                                    <th width="25%"><b>Trạng thái</b></th>
                                    <th width="25%"><b>Thời gian</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td width="25%" class="text-center"><b>{{ $item['admin_name'] }}</b></td>
                                        <td width="25%" class="text-center"><b>{{ $item['bill_id'] }}</b></td>
                                        <td width="25%"><b>{{ $item['status'] }}</b></td>
                                        <td width="25%"><b>{{ $item['created_at'] }}</b></td>
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
    {{-- submit form --}}
    <script>
        $(document).ready(function() {

            $('#select-bill_id').change(function() {
                $('#form-bill_id').submit();
            });
        });
    </script>
@endpush
