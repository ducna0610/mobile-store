@extends('user.layouts.master')

@section('content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <div class="pd-wrap">
        <div class="container">
            <div class="heading-section">
                <h2>Chi tiết sản phẩm</h2>
            </div>
            <div class="row">
                <div class="col-md-6" style="margin-bottom: 20px;">
                    <div id="slider" class="owl-carousel product-slider">
                        <div class="item">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                style="width: 300px;
                            margin: auto;" />
                        </div>
                        @if (isset($list_images) && !empty($list_images))
                            @foreach (json_decode($list_images) as $key => $img)
                                <div class="item">
                                    <img src="{{ asset('files/' . $img) }}"
                                        style=" height: 300px;
                                    margin: auto;">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <br>
                    <div id="thumb" class="owl-carousel product-thumb">
                        <div class="item">
                            <img src="{{ asset('storage/' . $product->image) }}">
                        </div>
                        @if (isset($list_images) && !empty($list_images))
                            @foreach (json_decode($list_images) as $key => $img)
                                <div class="item px-1">
                                    <img src="{{ asset('files/' . $img) }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price-discount">
                                <span id="price">{{ number_format($type->price) }}đ</span>
                            </div>
                        </div>
                        <p>
                            Pin: {{ $type->pin }} mAh
                            <br>
                            Chip: {{ $type->chip }}
                            <br>
                            Đã bán: {{ $type->sold }} sản phẩm
                            <br>
                            Đánh giá: {{ $type->sold }} sao
                        </p>
                        <form action="{{ route('carts.addToCart', $product->id) }}" id="form-add-to-card">
                            @csrf
                            <div class="row" style="margin-bottom: 40px;">
                                <div class="col-md-4">
                                    <label for="select-disks">Bộ nhớ</label>
                                    <select id="select-disks" class="form-control" name="disk">
                                        <option>{{ $type->disk }} GB</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="select-rams">Ram</label>
                                    <select id="select-rams" class="form-control" name="ram">
                                        <option>{{ $type->ram }} GB</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="select-colors">Màu</label>
                                    <select id="select-colors" class="form-control" name="color">
                                        <option>{{ $type->color }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="product-count">
                                <label for="size">Số lượng</label>
                                <div action="#" class="display-flex">
                                    <div class="qtyminus">-</div>
                                    <input type="numeric" name="quantity" id="input-add-to-cart" value="1"
                                        class="qty" inputmode="numeric">
                                    <div class="qtyplus">+</div>
                                </div>
                                <a id="btn-form-add-to-card" href="/" onclick="return false;" type="submit"
                                    class="round-black-btn">
                                    Thêm vào giỏ hàng
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="product-info-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                            aria-controls="description" aria-selected="true">Mô tả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                            aria-controls="review" aria-selected="false">Đánh giá ({{ $product->users()->count() }})</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        {{ $product->description }}
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="review-heading">Đánh giá</div>
                        @if ($product->users()->count())
                            @foreach ($product->users as $rate)
                                <div class="review">
                                    <b>
                                        {{ $product->users()->where('id', '=', $rate->pivot->user_id)->first()->name }}
                                    </b>

                                    <div class="star-rating">
                                        <ul class="list-inline" style="margin-bottom: 4px;">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rate->pivot->star)
                                                    <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                @else
                                                    <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                    </div>

                                    {{ $rate->pivot->comment }}
                                    <br>
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between">
                                            {{ $rate->pivot->created_at }}
                                            @auth
                                                @if ($rate->pivot->user_id == auth()->user()->id)
                                                    <a href="{{ route('bills.deleteRate', $product->id) }}"
                                                        style="color: #ffff" class="btn btn-danger btn-sm">Xóa</a>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="mb-20">Chưa có nhận xét nào.</p>
                        @endif
                        <form class="review-form" action="{{ route('bills.rate', $product->id) }}">
                            <div class="form-group">
                                <label>Đánh giá</label>
                                <div class="reviews-counter">
                                    <div class="rate">
                                        <input type="radio" id="star5" name="star" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="star" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="star" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="star" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="star" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    @error('star')
                                        <span style='color: red;'>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Bình luận</label>
                                <textarea class="form-control" rows="10" name="comment">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <span style='color: red;'>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <button class="round-black-btn">Xác nhận</button>
                        </form>
                    </div>
                </div>
            </div>

            <div style="text-align:center;font-size:14px;padding-bottom:20px;">
                Tết tưng bừng vui mừng mua sắm
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .pd-wrap {
            padding: 40px 0;
        }

        .heading-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .sub-heading {
            font-size: 12px;
            display: block;
            font-weight: 600;
            color: #2e9ca1;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .heading-section h2 {
            font-size: 32px;
            font-weight: 500;
            padding-top: 10px;
            padding-bottom: 15px;
        }

        .user-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            position: relative;
            min-width: 80px;
            background-size: 100%;
        }

        .carousel-testimonial .item {
            padding: 30px 10px;
        }

        .quote {
            position: absolute;
            top: -23px;
            color: #2e9da1;
            font-size: 27px;
        }

        .name {
            margin-bottom: 0;
            line-height: 14px;
            font-size: 17px;
            font-weight: 500;
        }

        .position {
            color: #adadad;
            font-size: 14px;
        }

        .owl-nav button {
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
            outline: none;
            height: 25px;
        }

        .owl-nav button svg {
            width: 25px;
            height: 25px;
        }

        .owl-nav button.owl-prev {
            left: 25px;
        }

        .owl-nav button.owl-next {
            right: 25px;
        }

        .owl-nav button span {
            font-size: 45px;
        }

        .product-thumb .item img {
            height: 100px;
        }

        .product-name {
            font-size: 22px;
            font-weight: 500;
            line-height: 22px;
            margin-bottom: 4px;
        }

        .product-price-discount {
            font-size: 22px;
            font-weight: 400;
            padding: 10px 0;
            clear: both;
        }

        .product-price-discount span.line-through {
            text-decoration: line-through;
            margin-left: 10px;
            font-size: 14px;
            vertical-align: middle;
            color: #a5a5a5;
        }

        .display-flex {
            display: flex;
        }

        .align-center {
            align-items: center;
        }

        .product-info {
            width: 100%;
        }

        .reviews-counter {
            font-size: 13px;
        }

        .reviews-counter span {
            vertical-align: -2px;
        }

        .rate {
            float: left;
            padding: 0 10px 0 0;
        }

        .rate:not(:checked)>input {
            position: absolute;
            left: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 15px;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 21px;
            color: #ccc;
            margin-bottom: 0;
            line-height: 21px;
        }

        .rate:not(:checked)>label:before {
            content: '\2605';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .product-dtl p {
            font-size: 14px;
            line-height: 24px;
            color: #7a7a7a;
        }

        .product-dtl .form-control {
            font-size: 15px;
        }

        .product-dtl label {
            line-height: 16px;
            font-size: 15px;
        }

        .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .product-count {
            margin-top: 15px;
        }

        .product-count .qtyminus,
        .product-count .qtyplus {
            width: 34px;
            height: 34px;
            background: #212529;
            text-align: center;
            font-size: 19px;
            line-height: 36px;
            color: #fff;
            cursor: pointer;
        }

        .product-count .qtyminus {
            border-radius: 3px 0 0 3px;
        }

        .product-count .qtyplus {
            border-radius: 0 3px 3px 0;
        }

        .product-count .qty {
            width: 60px;
            text-align: center;
        }

        .round-black-btn {
            border-radius: 4px;
            background: #212529;
            color: #fff;
            padding: 7px 45px;
            display: inline-block;
            margin-top: 20px;
            border: solid 2px #212529;
            transition: all 0.5s ease-in-out 0s;
        }

        .round-black-btn:hover,
        .round-black-btn:focus {
            background: transparent;
            color: #212529;
            text-decoration: none;
        }

        .product-info-tabs {
            margin-top: 25px;
        }

        .product-info-tabs .nav-tabs {
            border-bottom: 2px solid #d8d8d8;
        }

        .product-info-tabs .nav-tabs .nav-item {
            margin-bottom: 0;
        }

        .product-info-tabs .nav-tabs .nav-link {
            border: none;
            border-bottom: 2px solid transparent;
            color: #323232;
        }

        .product-info-tabs .nav-tabs .nav-item .nav-link:hover {
            border: none;
        }

        .product-info-tabs .nav-tabs .nav-item.show .nav-link,
        .product-info-tabs .nav-tabs .nav-link.active,
        .product-info-tabs .nav-tabs .nav-link.active:hover {
            border: none;
            border-bottom: 2px solid #d8d8d8;
            font-weight: bold;
        }

        .product-info-tabs .tab-content .tab-pane {
            padding: 30px 20px;
            font-size: 15px;
            line-height: 24px;
            color: #7a7a7a;
        }

        .review-form .form-group {
            clear: both;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .review-form .rate {
            float: none;
            display: inline-block;
        }

        .review-heading {
            font-size: 24px;
            font-weight: 600;
            line-height: 24px;
            margin-bottom: 6px;
            text-transform: uppercase;
            color: #000;
        }

        .review-form .form-control {
            font-size: 14px;
        }

        .review-form input.form-control {
            height: 40px;
        }

        .review-form textarea.form-control {
            resize: none;
        }

        .review-form .round-black-btn {
            text-transform: uppercase;
            cursor: pointer;
        }

        .review {
            background-color: aliceblue;
            padding: 16px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .star-rating li {
            padding: 0;
        }

        .star-rating i {
            font-size: 14px;
            color: #ffc000;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    {{-- carousel --}}
    <script>
        $(document).ready(function() {
            var slider = $("#slider");
            var thumb = $("#thumb");
            var slidesPerPage = 4; //globaly define number of elements per page
            var syncedSecondary = true;
            slider.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: false,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200
            }).on('changed.owl.carousel', syncPosition);
            thumb
                .on('initialized.owl.carousel', function() {
                    thumb.find(".owl-item").eq(0).addClass("current");
                })
                .owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    nav: true,
                    item: 4,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: slidesPerPage,
                    navText: [
                        '<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                        '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
                    ],
                    responsiveRefreshRate: 100
                }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);
                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                thumb
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = thumb.find('.owl-item.active').length - 1;
                var start = thumb.find('.owl-item.active').first().index();
                var end = thumb.find('.owl-item.active').last().index();
                if (current > end) {
                    thumb.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    thumb.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    slider.data('owl.carousel').to(number, 100, true);
                }
            }
            thumb.on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).index();
                slider.data('owl.carousel').to(number, 300, true);
            });


            $(".qtyminus").on("click", function() {
                var now = $(".qty").val();
                if ($.isNumeric(now)) {
                    if (parseInt(now) - 1 > 0) {
                        now--;
                    }
                    $(".qty").val(now);
                }
            })
            $(".qtyplus").on("click", function() {
                var now = $(".qty").val();
                if ($.isNumeric(now)) {
                    $(".qty").val(parseInt(now) + 1);
                }
            });
        });
    </script>

    {{-- ajax types --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ url('api/disks/' . $product->id) }}",
                success: function(response) {

                    $('#select-disks').empty();
                    response.data.forEach((each, value) => {
                        $('#select-disks').append(
                            `<option>
                        ${each.disk} GB
                    </option> `
                        );
                    });

                    const disk = $("#select-disks option:selected").val().replace(/[^\d.]/g, '');

                    $.ajax({
                        url: "{{ url('api/rams/' . $product->id) }}" + '?disk=' + disk,
                        success: function(response) {

                            $('#select-rams').empty();
                            response.data.forEach((each, value) => {
                                $('#select-rams').append(
                                    `<option>
                            ${each.ram} GB
                        </option> `
                                );
                            });

                            const ram = $("#select-rams option:selected").val().replace(
                                /[^\d.]/g, '');

                            console.log("{{ url('api/colors/' . $product->id) }}" +
                                '?disk=' + disk + '?ram=' + ram)

                            $.ajax({
                                url: "{{ url('api/colors/' . $product->id) }}" +
                                    '?disk=' + disk + '&&ram=' + ram,
                                success: function(response) {
                                    $('#select-colors').empty();
                                    response.data.forEach((each, value) => {
                                        $('#select-colors').append(
                                            `<option>
                                        ${each.color}
                                    </option> `
                                        );
                                    });

                                    const color = $(
                                            "#select-colors option:selected")
                                        .val();

                                    console.log(
                                        `{{ url('api/type/' . $product->id) }}` +
                                        '?disk=' + disk + '&&ram=' +
                                        ram + '&&color=' + color)

                                    $.ajax({
                                        url: "{{ url('api/type/' . $product->id) }}" +
                                            '?disk=' + disk + '&&ram=' +
                                            ram + '&&color=' + color,
                                        success: function(response) {
                                            //console.log(response)

                                            $('#price').html(
                                                numeral(response
                                                    .data[0]
                                                    .price)
                                                .format('0,0') +
                                                'đ');
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });

            $('#select-disks').change(function() {
                const disk = $("#select-disks option:selected").val().replace(/[^\d.]/g, '');

                $.ajax({
                    url: "{{ url('api/rams/' . $product->id) }}" + '?disk=' + disk,
                    success: function(response) {
                        $('#select-rams').empty();

                        response.data.forEach((each, value) => {
                            $('#select-rams').append(
                                `<option>
                                    ${each.ram} GB
                                </option> `
                            );
                        });

                        const ram = $("#select-rams option:selected").val();

                        $.ajax({
                            url: "{{ url('api/colors/' . $product->id) }}" +
                                '?disk=' + disk + '&&ram=' + ram,
                            success: function(response) {
                                $('#select-colors').empty();

                                response.data.forEach((each, value) => {
                                    $('#select-colors').append(
                                        `<option>
                                                ${each.color}
                                            </option> `
                                    );
                                });

                                const color = $(
                                        "#select-colors option:selected")
                                    .val();

                                $.ajax({
                                    url: "{{ url('api/type/' . $product->id) }}" +
                                        '?disk=' + disk + '&&ram=' +
                                        ram + '&&color=' + color,
                                    success: function(response) {
                                        //console.log(response)

                                        $('#price').html(
                                            numeral(response
                                                .data[0]
                                                .price)
                                            .format('0,0') +
                                            'đ');
                                    }
                                });
                            }
                        });
                    }
                });
            });

            $('#select-rams').change(function() {
                const disk = $("#select-disks option:selected").val().replace(/[^\d.]/g, '');

                const ram = $("#select-rams option:selected").val().replace(/[^\d.]/g, '');

                $.ajax({
                    url: "{{ url('api/colors/' . $product->id) }}" +
                        '?disk=' + disk + '&&ram=' + ram,
                    success: function(response) {
                        $('#select-colors').empty();

                        response.data.forEach((each, value) => {
                            $('#select-colors').append(
                                `<option>
                                                ${each.color}
                                            </option> `
                            );
                        });

                        const color = $(
                                "#select-colors option:selected")
                            .val();

                        $.ajax({
                            url: "{{ url('api/type/' . $product->id) }}" +
                                '?disk=' + disk + '&&ram=' +
                                ram + '&&color=' + color,
                            success: function(response) {
                                //console.log(response)

                                $('#price').html(
                                    numeral(response
                                        .data[0]
                                        .price)
                                    .format('0,0') +
                                    'đ');
                            }
                        });
                    }
                });
            });

            $('#select-colors').change(function() {
                const disk = $("#select-disks option:selected").val().replace(/[^\d.]/g, '');

                const ram = $("#select-rams option:selected").val().replace(/[^\d.]/g, '');

                const color = $("#select-colors option:selected").val();

                $.ajax({
                    url: "{{ url('api/type/' . $product->id) }}" +
                        '?disk=' + disk + '&&ram=' +
                        ram + '&&color=' + color,
                    success: function(response) {
                        //console.log(response)

                        $('#price').html(
                            numeral(response
                                .data[0]
                                .price)
                            .format('0,0') +
                            'đ');
                    }
                });
            });
        });
    </script>

    {{-- submit --}}
    <script>
        $('#btn-form-add-to-card').click(function(e) {

            let data = $('form#form-add-to-card').serialize();

            $.ajax({
                type: "POST",
                url: "{{ url('carts/add-to-cart', $product->id) }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response == 1) {
                        $.notify("Thêm sản phẩm thành công.", {
                            className: "success",
                            position: "left bottom"
                        });
                    } else {
                        $.notify("Thêm sản phẩm thất bại.", {
                            className: "error",
                            position: "left bottom"
                        });
                    }

                    $.ajax({
                        type: "GET",
                        url: "{{ url('carts/total-quantity') }}",
                        // data: "data",
                        dataType: "json",
                        success: function(response) {
                            $('#total_quantity').empty();
                            $('#total_quantity').append(response);
                        }
                    });
                }
            });

        });
    </script>
    {{-- comment --}}
    @if (request()->get('action'))
        <script>
            $(document).ready(function() {
                $('#description').removeClass(['show', 'active']);
                $('#description-tab').removeClass('active');

                $('#review').addClass(['show', 'active']);
                $('#review-tab').addClass('active');
            });
        </script>
    @endif

@endpush
