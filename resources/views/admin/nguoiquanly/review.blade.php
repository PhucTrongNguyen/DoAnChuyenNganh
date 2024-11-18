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
@if (!empty($ql) && count($ql) > 0)
@php    $index = 1; @endphp
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Người quản lý</h5>
                    <a href="{{ route('nguoiquanly.create') }}" class="btn btn-primary mb-3">Thêm người quản lý</a>
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Thao tác</th>
                                    <th>STT</th>
                                    <th>Tên QL</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Email</th>
                                    <th>Mật khẩu</th>
                                    <th>Địa chỉ</th>
                                    <th>Chức vụ</th>
                                    <th>Trạng thái tài khoản</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ql as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('nguoiquanly.edit', $item->MaQL) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <form action="{{ route('nguoiquanly.destroy', $item->MaQL) }}" method="POST"
                                                style="display:inline-block;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                        <td>{{$index++}}</td>
                                        <td>{{$item->TenQL}}</td>
                                        <td>{{$item->GioiTinh}}</td>
                                        <td>{{$item->NgaySinh}}</td>
                                        <td>{{$item->Email}}</td>
                                        <td>{{$item->MatKhau}}</td>
                                        <td>{{$item->DiaChi}}</td>
                                        <td>{{$item->ChucVu}}</td>
                                        <td>
                                            @if ($item->TrangThaiTK == 1)
                                                <span class="badge bg-success">Kích hoạt</span>
                                            @else
                                                <span class="badge bg-danger">Dừng</span>
                                            @endif
                                        </td>
                                        <td>{{$item->NgayTaoSP}}</td>
                                        <td>{{$item->NgaySuaSP}}</td>
                                        <td>{{$item->NgayXoaSP}}</td>
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