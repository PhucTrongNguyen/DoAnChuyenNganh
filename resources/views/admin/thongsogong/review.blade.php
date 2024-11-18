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
@if (!empty($g) && count($g) > 0)
@php    $index = 1; @endphp
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Địa chỉ khách hàng</h5>
                    <a href="{{ route('thongsogong.create') }}" class="btn btn-primary mb-3">Thêm gọng kính</a>
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Thao tác</th>
                                    <th>STT</th>
                                    <th>Tên CLG</th>
                                    <th>Màu gọng</th>
                                    <th>Chiều dài gọng</th>
                                    <th>Chiều rộng gọng</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($g as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('thongsogong.edit', $item->MaCLG) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <form action="{{ route('thongsogong.destroy', $item->MaCLG) }}" method="POST"
                                                style="display:inline-block;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                        <td>{{$index++}}</td>
                                        <td>{{$item->TenCLG}}</td>
                                        <td>{{$item->MauGong}}</td>
                                        <td>{{$item->ChieuDaiGongKinh}}</td>
                                        <td>{{$item->ChieuRongGongKinh}}</td>
                                        <td>{{$item->NgayTaoCLG}}</td>
                                        <td>{{$item->NgaySuaCLG}}</td>
                                        <td>{{$item->NgayXoaCLG}}</td>
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