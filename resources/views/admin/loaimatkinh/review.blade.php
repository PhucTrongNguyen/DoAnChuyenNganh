@extends('admin.index')
@section('content')
@if(session('success'))
    <div class="alert alert-success position-absolute z-index-3">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger position-absolute z-index-3">
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
@if (!empty($lmk) && count($lmk) > 0)
@php    $index = 1; @endphp
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Loại mắt kính</h5>
                    <a href="{{ route('loaimatkinh.create') }}" class="btn btn-primary mb-3">Thêm loại mắt kính</a>
                    <a href="{{ route('loaimatkinh.restore') }}" onclick="return confirmRestore()" class="btn btn-primary mb-3">Phục hồi loại mắt kính</a>
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Thao tác</th>
                                    <td>STT</td>
                                    <th>Tên Loại</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lmk as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('loaimatkinh.edit', $item->MaLoai) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <form action="{{ route('loaimatkinh.destroy', $item->MaLoai) }}" method="POST"
                                                style="display:inline-block;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                        <td>{{index++}}</td>
                                        <td>{{$item->TenLoai}}</td>
                                        <td>{{$item->NgayTaoLoaiMK}}</td>
                                        <td>{{$item->NgaySuaLoaiMK}}</td>
                                        <td>{{$item->NgayXoaLoaiMK}}</td>
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