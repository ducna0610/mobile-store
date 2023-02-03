@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">
                    <h2>Điện thoại <b>bán chạy</b></h2>
                    <div id="myCarousel" class="carousel" data-ride="carousel" data-interval="0">
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            <div class="item carousel-item active">
                                <div class="row">
                                    @foreach ($hot_products as $item)
                                        <div class="col-sm-6 col-lg-3 mb-4 product">
                                            <div class="thumb-wrapper" style="height: 400px;">
                                                <a href="{{ route('homes.detailProduct', $item->id) }}">
                                                    <div class="img-box">
                                                        <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid"
                                                            alt="">
                                                    </div>
                                                    <h4>{{ $item->name }}</h4>
                                                </a>
                                                <div class="thumb-content">
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $item->star)
                                                                    <li class="list-inline-item"><i class="fa fa-star"></i>
                                                                    </li>
                                                                @else
                                                                    <li class="list-inline-item"><i
                                                                            class="fa fa-star-o"></i></li>
                                                                @endif
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <p class="item-price">
                                                        <b style="color: red;">{{ number_format($item->price) }}đ</b>
                                                        ({{ $item->specifications }} cấu hình)
                                                        <br>
                                                        ({{ $item->rates . ' đánh giá / đã bán ' . $item->total_sold }})
                                                    </p>
                                                    <a href="{{ route('homes.detailProduct', $item->id) }}"
                                                        class="btn">Chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-2">
                <br>
                <form>
                    <div>
                        <b>Giá tiền</b>
                        <select class="form-select" name="price">
                            <option value="">Tất cả</option>
                            <option value="0-2000000" @selected(request()->get('price') == '0-2000000')>Dưới 2 triệu</option>
                            <option value="2000000-4000000" @selected(request()->get('price') == '2000000-4000000')>Từ 2 - 4 triệu</option>
                            <option value="4000000-7000000" @selected(request()->get('price') == '4000000-7000000')>Từ 4 - 7 triệu</option>
                            <option value="7000000-13000000" @selected(request()->get('price') == '7000000-13000000')>Từ 7 - 13 triệu</option>
                            <option value="13000000-999999000" @selected(request()->get('price') == '13000000-999999000')>Trên 13 triệu</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <b>Đánh giá</b>
                        <select class="form-select" name="star">
                            <option>Tất cả</option>
                            <option @selected(request()->get('star') == '2') value="2">Trên 2 sao</option>
                            <option @selected(request()->get('star') == '3') value="3">Trên 3 sao</option>
                            <option @selected(request()->get('star') == '4') value="4">Trên 4 sao</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <b>
                            Thương hiệu
                        </b>
                        <select class="form-select" name="manufacturer_id">
                            <option>Tất cả</option>
                            @foreach ($manufacturers as $manufacturer)
                                <option @selected(request()->get('manufacturer_id') == $manufacturer->id) value="{{ $manufacturer->id }}">
                                    {{ $manufacturer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <b>
                            Sắp xếp
                        </b>
                        <select class="form-select" name="sort">
                            <option>Tất cả</option>
                            <option value="price-asc" @selected(request()->get('sort') == 'price-asc')>Giá tăng dần
                            </option>
                            <option value="price-desc" @selected(request()->get('sort') == 'price-desc')>Giá giảm dần
                            </option>
                            <option value="star-asc" @selected(request()->get('sort') == 'star-asc')>Sao tăng dần</option>
                            <option value="star-desc" @selected(request()->get('sort') == 'star-desc')>Sao giảm dần
                            </option>
                            <option value="name-asc" @selected(request()->get('sort') == 'name-asc')>Tên A-Z</option>
                            <option value="name-desc" @selected(request()->get('sort') == 'name-desc')>Tên Z-A</option>
                        </select>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-warning">
                            Tìm kiếm
                        </button>
                    </div>
                </form>

                <br>
            </div>
            <div class="col-md-10 col-12">
                <div class="companyMenu group flexContain">
                    @foreach ($manufacturers as $manufacturer)
                        <a href="?manufacturer_id={{ $manufacturer->id }}">
                            <img src="{{ asset('storage/' . $manufacturer->logo) }}">
                        </a>
                    @endforeach
                </div>
                @if (request()->has('manufacturer_id') || request()->has('sort') || request()->has('q'))
                    <div class="choosedFilter flexContain">
                        <button class="btn btn-info" onclick=window.location="{{ url()->current() }}">
                            Xóa bộ lọc
                        </button>
                    </div>
                @endif
                <hr>
                <br>
                <div class="container-xl">
                    <div class="carousel" data-ride="carousel" style="padding: 0; margin: 0;">
                        <div class="carousel-inner">
                            <div class="item carousel-item active">
                                <div class="row">
                                    @foreach ($products as $item)
                                        <div class="col-sm-4 col-6 col-md-3 mb-4 product">
                                            <div class="thumb-wrapper" style="height: 400px;">
                                                <a href="{{ route('homes.detailProduct', $item->id) }}">
                                                    <div class="img-box">
                                                        <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid"
                                                            alt="">
                                                    </div>
                                                    <h4>{{ $item->name }}</h4>
                                                </a>
                                                <div class="thumb-content">
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $item->star)
                                                                    <li class="list-inline-item"><i class="fa fa-star"></i>
                                                                    </li>
                                                                @else
                                                                    <li class="list-inline-item"><i
                                                                            class="fa fa-star-o"></i></li>
                                                                @endif
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <p class="item-price">
                                                        <b style="color: red;">{{ number_format($item->price) }}đ</b>
                                                        ({{ $item->specifications }} cấu hình)
                                                        <br>
                                                        ({{ $item->rates . ' đánh giá / đã bán ' . $item->total_sold }})
                                                    </p>
                                                    <a href="{{ route('homes.detailProduct', $item->id) }}"
                                                        class="btn">Chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- paginate --}}
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        h2 {
            color: #000;
            font-size: 26px;
            font-weight: 300;
            text-align: center;
            text-transform: uppercase;
            position: relative;
            margin: 40px 0 30px;
        }

        .carousel {
            margin: 50px auto;
            padding: 0 70px;
        }

        .carousel .item {
            color: #747d89;
            min-height: 400px;
            text-align: center;
            overflow: hidden;
        }

        .carousel .thumb-wrapper {
            padding: 25px 15px;
            background: #fff;
            border-radius: 6px;
            text-align: center;
            position: relative;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
        }

        .carousel .item .img-box {
            height: 160px;
            margin-bottom: 20px;
            width: 100%;
            position: relative;
        }

        .carousel .item img {
            max-width: 100%;
            max-height: 100%;
            display: inline-block;
            position: absolute;
            bottom: 0;
            margin: 0 auto;
            left: 0;
            right: 0;
        }

        .carousel .item h4 {
            font-size: 18px;
        }

        .carousel .item h4,
        .carousel .item p,
        .carousel .item ul {
            margin-bottom: 5px;
        }

        .carousel .thumb-content .btn {
            color: #7ac400;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            background: none;
            border: 1px solid #7ac400;
            padding: 6px 14px;
            margin-top: 5px;
            line-height: 16px;
            border-radius: 20px;
        }

        .carousel .thumb-content .btn:hover,
        .carousel .thumb-content .btn:focus {
            color: #fff;
            background: #7ac400;
            box-shadow: none;
        }

        .carousel .thumb-content .btn i {
            font-size: 14px;
            font-weight: bold;
            margin-left: 5px;
        }

        .carousel .item-price {
            font-size: 13px;
            padding: 2px 0;
        }

        .carousel .item-price strike {
            opacity: 0.7;
            margin-right: 5px;
        }

        .star-rating li {
            padding: 0;
        }

        .star-rating i {
            font-size: 12px;
            color: #ffc000;
        }

        .icon-cart {
            padding-right: 6px;
        }

        .companyMenu {
            margin: 10px 0 30px;
        }

        .companyMenu a {
            border: 2px solid #fff;
            height: 44px;
            line-height: 40px;
            margin: 4px;
            transition-duration: .2s;
        }

        .companyMenu a:hover {
            border: 2px solid #aaa;
            transform: scale(1.1);
            z-index: 20;
        }

        .companyMenu a img {
            max-height: 40px;
            vertical-align: middle;
            margin-top: -3px;
        }

        .flexContain {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .group:before,
        .group:after {
            content: "";
            display: table;
        }

        .group:after {
            clear: both;
        }

        .group {
            zoom: 1;
            /* For IE 6/7 (trigger hasLayout) */
        }

        /* Ten san pham */
        .product h4 {
            display: block;
            padding: 0 10px;
            color: #333;
            line-height: 1.3em;
            font-size: 15px;
            font-weight: normal;
        }

        /* Hightlight ten san pham khi hover */
        .product a:hover h4 {
            color: #288ad6;
        }

        a {
            text-decoration: none;
        }
    </style>
@endpush
