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
@if (!empty($ncc) && count($ncc) > 0)
@php    $index = 1; @endphp
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nhà cung cấp</h5>
                    <a href="{{ route('nhacungcap.create') }}" class="btn btn-primary mb-3">Thêm nhà cung cấp</a>
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Thao tác</th>
                                    <th>STT</th>
                                    <th>Tên NCC</th>
                                    <th>Địa chỉ NCC</th>
                                    <th>Mô tả</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ncc as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('nhacungcap.edit', $item->MaNCC) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <form action="{{ route('nhacungcap.destroy', $item->MaNCC) }}" method="POST"
                                                style="display:inline-block;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                        <td>{{$index++}}</td>
                                        <td>{{$item->TenNCC}}</td>
                                        <td>{{$item->DiaChiNCC }}</td>
                                        <td>{{$item->MoTa}}</td>
                                        <td>{{$item->NgayTaoNCC}}</td>
                                        <td>{{$item->NgaySuaNCC}}</td>
                                        <td>{{$item->NgayXoaNCC}}</td>
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