@extends('user.index')

@section('content')
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="container mt-5">
    <h2>Danh sách sản phẩm yêu thích</h2>
    <div id="favorite-products-container">
        @include('user.danhsachyeuthich.favorites-list', ['soLuongSanPham' => $soLuongSanPham])
    </div>
</div>
@endsection
