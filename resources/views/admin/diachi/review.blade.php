@extends('admin.index')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    @if (!empty($dc) && count($dc) > 0)
            @php    $index = 1; @endphp
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Địa chỉ khách hàng</h5>
                            <!-- <a href="{{ route('sanpham.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a> -->
                            <!-- Table with stripped rows -->
                            <div style="overflow-x: auto">
                                <table class="table datatable" style="table-layout: auto; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên KH</th>
                                            <th>Loại địa chỉ</th>
                                            <th>Đường</th>
                                            <th>Phường/Xã</th>
                                            <th>Quận/Huyện</th>
                                            <th>Thành phố/Tỉnh</th>
                                            <th>Thông tin địa chỉ</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dc as $item)
                                            <tr>
                                                <td>{{ $index++ }}</td>
                                                @foreach ($item->khachHangs as $kh)
                                                <td>{{$kh->TenKH}}</td>
                                                <td>{{$item->LoaiDC}}</td>
                                                <td>{{$item->Duong}}</td>
                                                <td>{{$item->Phuong}}</td>
                                                <td>{{$item->Quan}}</td>
                                                <td>{{$item->ThanhPho}}</td>
                                                <td>{{$item->NgayTaoDC}}</td>
                                                <td>{{$item->NgaySuaDC}}</td>
                                                <td>{{$item->NgayXoaDC}}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif
@endsection