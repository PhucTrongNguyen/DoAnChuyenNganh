@extends('admin.index')
@section('content')
@if(session('success'))
    <div class="alert alert-success position-absolute">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger position-absolute">
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
@if (!empty($tr) && count($tr) > 0)
@php    $index = 1; @endphp
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông số tròng</h5>
                    <a href="{{ route('thongsotrong.create') }}" class="btn btn-primary mb-3">Thêm tròng kính</a>
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Thao tác</th>
                                    <th>STT</th>
                                    <th>Tên CLT</th>
                                    <th>Màu gòng</th>
                                    <th>Độ rộng tròng kính</th>
                                    <th>Độ cao tròng kính</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tr as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('thongsotrong.edit', $item->MaCLT) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <form action="{{ route('thongsotrong.destroy', $item->MaCLT) }}" method="POST"
                                                style="display:inline-block;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                        <td>{{$index++}}</td>
                                        <td>{{$item->TenCLT}}</td>
                                        <td>{{$item->MauTrong}}</td>
                                        <td>{{$item->DoRongTrong}}</td>
                                        <td>{{$item->DoCaoTrong}}</td>
                                        <td>{{$item->NgayTaoCLT}}</td>
                                        <td>{{$item->NgaySuaCLT}}</td>
                                        <td>{{$item->NgayXoaCLT}}</td>
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