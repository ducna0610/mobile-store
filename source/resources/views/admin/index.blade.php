@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="item" style="background-color: #d5e5a3">
            <div class="title">
                <i class="ti-widget-alt" aria-hidden="true"></i>
                Đơn hàng cần xử lý
            </div>
            <div class="content">
                <h3>
                    +{{ $num_orders }}
                </h3>
            </div>
        </div>
        <div class="item" style="background-color: #b8d8d8">
            <div class="title">
                <i class="ti-mobile" aria-hidden="true"></i>
                Sản phẩm bán được
            </div>
            <div class="content">
                <h3>
                    +{{ $num_products ?? 0 }}
                </h3>
            </div>
        </div>
        <div class="item" style="background-color: #ffff">
            <div class="title">
                <i class="ti-user" aria-hidden="true"></i>
                Tài khoản đăng ký
            </div>
            <div class="content">
                <h3>
                    +{{ $num_users }}
                </h3>
            </div>
        </div>
    </div>
@endsection
<style>
    .item {
        border-radius: 8px;
        margin: 10px;
    }

    .title {
        padding: 30px;
        font-size: 30px;
    }

    .content {
        text-align: center;
        padding: 8px;
        font-size: 30px;
    }

    /* Tablet PC*/
    @media (min-width: 740px) {
        .row {
            display: flex;
            justify-content: space-between;
        }
    }
</style>
@push('css')
@endpush
