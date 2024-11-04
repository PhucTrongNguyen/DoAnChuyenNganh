@extends('user.index')

@section('content')
@php
    $total = 0;
@endphp
<div class="container">
    <h2>{{ translateText('Đơn hàng của bạn')}}</h2>
    <div id="order-products-container">
        @include('user.donhang.order-list', ['dh' => $dh])
    </div>

</div>
@endsection