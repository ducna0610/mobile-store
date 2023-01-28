@extends('admin.layouts.master')

@section('content')
    @foreach ($arrAdminRole as $key => $value)
        <input type="radio" value="{{ $key }}"> {{ $value }}
    @endforeach
@endsection
