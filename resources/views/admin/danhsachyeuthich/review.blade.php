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
    @if (!empty($ds) && count($ds) > 0)
    @php    $index = 1; @endphp
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách yêu thích</h5>
                    <!-- <a href="{{ route('sanpham.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a> -->
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên KH</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($ds as $item)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{$item->khachHang->TenKH}}</td>
                                        @foreach ($item->sanPhams as $sp)
                                        <td>{{$sp->TenSP}}</td>
                                        @endforeach
                                        <td>{{$item->NgayTaoDS}}</td>
                                        <td>{{$item->NgaySuaDS}}</td>
                                        <td>{{$item->NgayXoaDS}}</td>
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
@endsection