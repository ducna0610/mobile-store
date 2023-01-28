@extends('user.layouts.master')

@section('content')
    <div class="form-box">
        <h1 class="text-center">Đặt hàng</h1>
        <form action="{{ route('carts.checkout') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name_receiver">Tên người nhận</label>
                <input class="form-control" type="text" id="name_receiver" name="name_receiver"
                    value="{{ old('name_receiver') ?? $user->name }}" required>
                @error('name_receiver')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone_receiver">Số điện thoại</label>
                <input class="form-control" type="text" id="phone_receiver" name="phone_receiver"
                    value="{{ old('phone_receiver') ?? $user->phone }}" required>
                @error('phone_receiver')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address_receiver">Địa chỉ</label>
                <textarea class="form-control" id="address_receiver" name="address_receiver" required>{{ old('address_receiver') ?? $user->address }}</textarea>
                @error('address_receiver')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="note">Ghi chú</label>
                <textarea class="form-control" id="note" name="note">{{ old('note') }}</textarea>
                @error('note')
                    <span style='color: red;'>
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <input class="btn btn-primary" type="submit" value="Xác nhận" />
        </form>
    </div>
    </div>
@endsection

@push('css')
    <style>
        .form-box {
            max-width: 600px;
            margin: auto;
            padding: 50px;
            background: #ffffff;
            margin-top: 40px;
            margin-bottom: 111px;
            border-radius: 12px;
        }

        input,
        textarea {
            width: 100%;
        }
    </style>
@endpush
