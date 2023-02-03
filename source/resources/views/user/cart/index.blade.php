@extends('user.layouts.master')

@section('content')
    @if (!session('cart'))
        <div class="empty">
            Giỏ hàng trống
        </div>
    @else
        <div class="cart_section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="cart_container">
                            <div class="cart_items">
                                <ul class="cart_list">
                                    <?php $total = 0; ?>
                                    @foreach (session('cart')->reverse() as $product)
                                        @foreach ($product as $item)
                                            <li class="cart_item clearfix">
                                                <div class="row">
                                                    <div class="cart_item_image my-3 col-md-2 col-xs-12">
                                                        <a href="{{ route('homes.detailProduct', $item['product_id']) }}">
                                                            <img src="{{ asset($item['image']) }}" style="max-width: 120px;"
                                                                alt="img">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-3 col-xs-12">
                                                        <div class="row">
                                                            <div class="cart_item_title mb-3 col-md-12 col-3">Tên sản phẩm
                                                            </div>
                                                            <div
                                                                class="cart_item_text col-md-12 col-9 col-md-12 col-9 mb-3">
                                                                {{ $item['name'] }}
                                                                <hr>
                                                                Bộ nhớ: {{ $item['disk'] }} GB
                                                                <br>
                                                                Ram: {{ $item['ram'] }} GB
                                                                <br>
                                                                Chip: {{ $item['chip'] }}
                                                                <br>
                                                                Pin: {{ $item['pin'] }} mAh
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
                                                                        {{ $item['color'] }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-xs-12">
                                                                <div class="row">
                                                                    <div class="cart_item_title mb-3 col-md-12 col-3">
                                                                        Số lượng
                                                                    </div>
                                                                    <span
                                                                        class="cart_item_text col-md-12 col-9 span-quantity">
                                                                        {{ $item['quantity'] }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="row">
                                                                    <div class="cart_item_title mb-3 col-md-12 col-3">
                                                                        Giá
                                                                    </div>
                                                                    <span class="cart_item_text col-md-12 col-9 span-price"
                                                                        data-price={{ $item['price'] }}>
                                                                        {{ number_format($item['price']) }}đ
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="row">
                                                                    <div class="cart_item_title mb-3 col-md-12 col-3">
                                                                        Thành tiền
                                                                    </div>
                                                                    <span class="cart_item_text col-md-12 col-9 span-sum"
                                                                        data-sum={{ $item['price'] * $item['quantity'] }}>
                                                                        <?php $total += $item['price'] * $item['quantity']; ?>
                                                                        {{ number_format($item['price'] * $item['quantity']) }}đ
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <br>
                                                        <div class="row">
                                                            <div class="d-flex justify-content-end">
                                                                <a class="px-4 m-2 btn btn-danger delete"
                                                                    data-type_id={{ $item['type_id'] }}>
                                                                    Xóa tất cả
                                                                </a>
                                                                <a class="px-4 m-2 btn btn-outline-danger btn-update-quantity"
                                                                    data-type_id={{ $item['type_id'] }} data-type='decre'>
                                                                    -
                                                                </a>
                                                                <a class="px-4 m-2 btn btn-outline-info btn-update-quantity"
                                                                    data-type_id={{ $item['type_id'] }} data-type='incre'>
                                                                    +</a>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                            <div class="order_total">
                                <div class="order_total_content text-md-right">
                                    <div class="order_total_title">Tổng tiền:</div>
                                    <span class="order_total_amount span-total">{{ number_format($total) }}đ</span>
                                </div>
                            </div>
                            <div class="cart_buttons">
                                <button type="button" class="cart_button_clear"
                                    onclick=window.location="{{ route('homes.index') }}">
                                    Tiếp tục mua sắm
                                </button>
                                <button type="button" class="button cart_button_checkout"
                                    onclick=window.location="{{ route('carts.order') }}">
                                    Đặt hàng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('css')
    <style>
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
            font-weight: 500;
            background-color: #FFFFFF;
            padding: 12px;
            border-radius: 12px;
            text-align: center;
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

        .order_total_amount {
            display: inline-block;
            font-size: 18px;
            font-weight: 500;
            margin-left: 26px;
            line-height: 60px
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
            margin-right: 26px
        }

        .cart_button_clear:hover {
            border-color: #0e8ce4;
            color: #0e8ce4
        }

        .cart_button_checkout {
            display: inline-block;
            border: none;
            font-size: 18px;
            font-weight: 400;
            line-height: 48px;
            color: #FFFFFF;
            padding-left: 35px;
            padding-right: 35px;
            outline: none;
            cursor: pointer;
            vertical-align: top
        }

        .empty {
            font-size: 30px;
            font-weight: 500;
            background-color: #ffff;
            padding: 40px;
            margin: 40px;
            border-radius: 12px;
            text-align: center;
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('.btn-update-quantity').click(function() {
                let btn = $(this);
                let type_id = btn.data('type_id');
                let type = btn.data('type');

                $.ajax({
                    type: "POST",
                    url: "{{ url('carts/update-quantity-cart') }}/" + type_id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        type,
                    },
                    dataType: "json",

                    success: function(response) {
                        if (response == 1) {
                            $.notify("Cập nhật thành công.", {
                                className: "success",
                                position: "left bottom"
                            });
                        } else {
                            $.notify("Cập nhật thất bại.", {
                                className: "error",
                                position: "left bottom"
                            });
                        }

                        let parent_li = btn.parents('li');

                        let price = parent_li.find('.span-price').data('price');
                        let quantity = parent_li.find('.span-quantity').text();

                        if (type == 'incre') {
                            quantity++;
                        } else if (type = 'decre') {
                            quantity--;
                        }

                        parent_li.find('.span-quantity').text(quantity);

                        let sum = price * quantity;
                        parent_li.find('.span-sum').text(numeral(sum)
                            .format('0,0') +
                            'đ');
                        parent_li.find('.span-sum').attr('data-sum', sum);

                        if (quantity == 0) {
                            parent_li.remove();
                        }

                        getTotal();

                        $.ajax({
                            type: "GET",
                            url: "{{ url('carts/total-quantity') }}",
                            dataType: "json",
                            success: function(response) {
                                $('#total_quantity').empty();
                                $('#total_quantity').append(response);
                            }
                        });
                    }
                });
            })

            $('.delete').click(function() {
                let btn = $(this);
                let type_id = btn.data('type_id');

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('carts/delete-item-cart') }}/" + type_id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",

                    success: function(response) {
                        if (response == 1) {
                            $.notify("Cập nhật thành công.", {
                                className: "success",
                                position: "left bottom"
                            });
                        } else {
                            $.notify("Cập nhật thất bại.", {
                                className: "error",
                                position: "left bottom"
                            });
                        }

                        let parent_li = btn.parents('li');
                        parent_li.remove();

                        getTotal();

                        $.ajax({
                            type: "GET",
                            url: "{{ url('carts/total-quantity') }}",
                            dataType: "json",
                            success: function(response) {
                                $('#total_quantity').empty();
                                $('#total_quantity').append(response);
                            }
                        });
                    }
                });
            })
        });

        function getTotal() {
            let total = 0;

            $('.span-sum').each(function() {
                total += parseFloat($(this).attr('data-sum'));
            })

            if (total) {
                $('.span-total').text(numeral(total)
                    .format('0,0') +
                    'đ');
            } else {
                window.location = "{{ route('carts.showCart') }}";
            }
        }
    </script>
@endpush
