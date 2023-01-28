@extends('user.layouts.master')

@section('content')
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Thời gian đặt</th>
                <th>Người nhận</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th class="text-center">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @if (count($bills))
                @foreach ($bills as $bill)
                    <tr>
                        <td data-column="#">{{ $bill->id }}</td>
                        <td data-column="Thời gian đặt">{{ $bill->created_at }}</td>
                        <td data-column="Người nhận">{{ $bill->name_receiver }}</td>
                        <td data-column="Số điện thoại">{{ $bill->phone_receiver }}</td>
                        <td data-column="Địa chỉ">{{ Str::limit($bill->address_receiver, 20, '...') }}</td>
                        <td data-column="Trạng thái">{{ $bill->status }}</td>
                        <td data-column="Chi tiết">
                            <a href="{{ route('bills.billDetail', $bill->id) }}">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" data-column="Hiện tại">
                        Bạn chưa đặt đơn hàng nào
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection

@push('css')
    <style>
        table {
            width: 1200px;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td,
        th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 18px;
        }

        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {

            table {
                width: 100%;
            }

            /* Force table to not be like tables anymore */
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
                padding-left: 10px;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: left;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                /* Label the data */
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }
        }
    </style>
@endpush
