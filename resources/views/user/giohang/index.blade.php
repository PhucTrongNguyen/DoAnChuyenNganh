@extends('user.index')

@section('content')
@php
    $total = 0;
@endphp

<div class="container mt-5">
    <h2>{{ translateText('Giỏ hàng của bạn')}}</h2>
    <div id="cart-products-container">
        @include('user.giohang.cart-list', ['sanPhamTrongGH' => $sanPhamTrongGH])
    </div>
</div>
@endsection