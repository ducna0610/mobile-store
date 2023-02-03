@extends('user.layouts.master')

@section('content')
    <div class="cart_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Đơn hàng<small> ({{ $bill->created_at }} )
                            </small></div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($data as $item)
                                    <li class="cart_item clearfix">
                                        <div class="row">
                                            <div class="cart_item_image my-3 col-md-2 col-xs-12">
                                                <a href="{{ route('homes.detailProduct', $item['type_id']->product->id) }}">
                                                    <img src="{{ asset('storage/' . $item['type_id']->product->image) }}"
                                                        style="max-width: 120px;" alt="img">
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-xs-12">
                                                <div class="row">
                                                    <div class="cart_item_title mb-3 col-md-12 col-3">Tên sản phẩm
                                                    </div>
                                                    <div class="cart_item_text col-md-12 col-9 col-md-12 col-9 mb-3">
                                                        {{ $item['type_id']->product->name }}
                                                        <hr>
                                                        Bộ nhớ: {{ $item['type_id']['disk'] }} GB
                                                        <br>
                                                        Ram: {{ $item['type_id']['ram'] }} GB
                                                        <br>
                                                        Chip: {{ $item['type_id']['chip'] }}
                                                        <br>
                                                        Pin: {{ $item['type_id']['pin'] }} mAh
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-md-4 col-xs-12">
                                                        <div class="row">
                                                            <div class="cart_item_title mb-3 col-md-12 col-3">Màu
                                                            </div>
                                                            <div class="cart_item_text col-md-12 col-9">
                                                                {{ $item['type_id']['color'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <div class="row">
                                                            <div class="cart_item_title mb-3 col-md-12 col-3">
                                                                Số lượng
                                                            </div>
                                                            <div class="cart_item_text col-md-12 col-9">
                                                                {{ $item['quantity'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-xs-12">
                                                        <div class="row">
                                                            <div class="cart_item_title mb-3 col-md-12 col-3">Giá
                                                            </div>
                                                            <div class="cart_item_text col-md-12 col-9">
                                                                {{ number_format($item['price']) }}đ</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-xs-12">
                                                        <div class="row">
                                                            <div class="cart_item_title mb-3 col-md-12 col-3">
                                                                Thành tiền
                                                            </div>
                                                            <div class="cart_item_text col-md-12 col-9">
                                                                {{ number_format($item['price'] * $item['quantity']) }}đ
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <br>
                                                @if ($bill['status'] == 2)
                                                    <div class="row">
                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ route('homes.detailProduct', $item['type_id']->product->id) . '?action=review#review' }}"
                                                                class="px-4 m-2 btn btn-secondary">
                                                                Đánh giá
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                <br>
                                            </div>
                                            <hr>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Tổng tiền:</div>
                                <div class="order_total_amount">{{ number_format($bill->total_price) }}đ</div>
                                <div class="order_total_status">
                                    {{ $bill['status_name'] }}
                                </div>
                            </div>
                        </div>
                        <div style="display:flex; justify-content: space-between; width: 100%;">
                            <div class="text">
                                <div class="note_title">Ghi chú:</div>
                                {{ $bill['note'] }}
                            </div>

                            <div class="text">
                                <div class="note_title">Địa chỉ:</div>
                                {{ $bill['address_receiver'] }}

                                <div class="note_title">Số điện thoại:</div>
                                {{ $bill['phone_receiver'] }}
                            </div>
                        </div>
                        <div class="cart_buttons">
                            @if ($bill['status'] == 0)
                                <button type="button" class="cart_button_clear" style="margin-right: 40px; color: red"
                                    onclick=window.location="{{ route('bills.cancel', $bill->id) }}">
                                    Hủy
                                </button>
                            @endif
                            <button type="button" class="cart_button_clear"
                                onclick=window.location="{{ route('homes.index') }}">
                                Tiếp tục mua sắm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -webkit-text-shadow: rgba(0, 0, 0, .01) 0 0 1px;
            text-shadow: rgba(0, 0, 0, .01) 0 0 1px
        }

        .cart_container {
            display: absolute;
        }

        ul {
            list-style: none;
            margin-bottom: 0px
        }

        .button {
            display: inline-block;
            background: #0e8ce4;
            border-radius: 5px;
            height: 48px;
            -webkit-transition: all 200ms ease;
            -moz-transition: all 200ms ease;
            -ms-transition: all 200ms ease;
            -o-transition: all 200ms ease;
            transition: all 200ms ease
        }

        .button a {
            display: block;
            font-size: 18px;
            font-weight: 400;
            line-height: 48px;
            color: #FFFFFF;
            padding-left: 35px;
            padding-right: 35px
        }

        .button:hover {
            opacity: 0.8
        }

        .cart_section {
            width: 100%;
            padding-top: 40px;
            padding-bottom: 111px
        }

        .cart_title {
            font-size: 30px;
            font-weight: 500
        }

        .cart_items {
            margin-top: 8px
        }

        .cart_list {
            border: solid 1px #e8e8e8;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff
        }

        .cart_item {
            width: 100%;
            padding: 15px;
            padding-right: 46px
        }

        .cart_item_image img {
            max-width: 100%;
            align-items: center;
        }

        .cart_item_info {
            width: calc(100% - 133px);
            float: left;
            padding-top: 18px
        }

        .cart_item_name {
            margin-left: 7.53%
        }

        .cart_item_title {
            font-size: 14px;
            font-weight: 400;
            color: rgba(0, 0, 0, 0.5)
        }

        .cart_item_text {
            font-size: 18px;
        }

        .cart_item_text span {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 11px;
            -webkit-transform: translateY(4px);
            -moz-transform: translateY(4px);
            -ms-transform: translateY(4px);
            -o-transform: translateY(4px);
            transform: translateY(4px)
        }

        .cart_item_price {
            text-align: right
        }

        .cart_item_total {
            text-align: right
        }

        .order_total {
            width: 100%;
            height: 60px;
            margin-top: 30px;
            border: solid 1px #e8e8e8;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
            padding-right: 46px;
            padding-left: 15px;
            background-color: #fff
        }

        .order_total_title {
            display: inline-block;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.5);
            line-height: 60px
        }

        .note_title {
            font-size: 14px;
            color: rgba(0, 0, 0, 0.5);
            line-height: 40px
        }

        .order_total_amount {
            display: inline-block;
            font-size: 18px;
            font-weight: 500;
            margin-left: 26px;
            line-height: 60px;
        }

        .order_total_status {
            display: inline-block;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.5);
            line-height: 60px;
            float: right;
            padding-left: 40px;
        }

        .cart_buttons {
            margin-top: 60px;
            text-align: right
        }

        .cart_button_clear {
            display: inline-block;
            border: none;
            font-size: 18px;
            font-weight: 400;
            line-height: 48px;
            color: rgba(0, 0, 0, 0.5);
            background: #FFFFFF;
            border: solid 1px #b2b2b2;
            padding-left: 35px;
            padding-right: 35px;
            outline: none;
            cursor: pointer;
        }

        .cart_button_clear:hover {
            border-color: #0e8ce4;
            color: #0e8ce4
        }


        .text {
            display: inline-block;
            width: 49%;
            padding: 8px;
            margin-top: 30px;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff
        }

        .cart_button_cancel {
            display: inline-block;
            border: none;
            font-size: 18px;
            font-weight: 400;
            line-height: 48px;
            background-color: #FF6347;
            padding-left: 35px;
            padding-right: 35px;
            outline: none;
            cursor: pointer;
            vertical-align: top
        }
    </style>
@endpush
