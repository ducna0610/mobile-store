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
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $manufacturer->logo) }}">
                            <br>
                            <div>
                                Số sản phẩm: {{ $manufacturer->products_count }}
                                <br>
                            </div>
                            <br>
                        </div>
                        <div class="col-md-8" style="font-size: 22px">
                            Tên nhà sản xuất:
                            <b>
                                {{ $manufacturer->name }}
                            </b>
                            <br>
                            <br>
                            Email nhà sản xuất:
                            <b>
                                <a href="mailto:{{ $manufacturer->email }}">
                                    {{ $manufacturer->email }}
                                </a>
                            </b>
                            <br>
                            <br>
                            Số điện thoại nhà sản xuất:
                            <b>
                                <a href="tel:{{ $manufacturer->phone }}">
                                    {{ $manufacturer->phone }}
                                </a>
                            </b>
                            <br>
                            <br>
                            Địa chỉ nhà sản xuất:
                            <b>
                                {{ $manufacturer->address }}
                            </b>
                        </div>
                    </div>
                </div>
                <div class="card-content table-responsive table-full-width">
                </div>
            </div>
        </div>
    </div>
@endsection
