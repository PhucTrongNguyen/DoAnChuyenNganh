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
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Datatables</h5>
                    <a href="{{ route('sanpham.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Thao tác</th>
                                    <th>Ảnh</th>
                                    <th>Tên SP</th>
                                    <th>Giới tính</th>
                                    <th>Thương hiệu</th>
                                    <th>Loại</th>
                                    <th>Độ mắt kính</th>
                                    <th>Thống số gòng</th>
                                    <th>Thống số tròng</th>
                                    <th>Giá</th>
                                    <th>Số lượng tồn</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sp as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('sanpham.edit', $item->MaSP) }}"
                                                class="btn btn-warning">Sửa</a>
                                            <form action="{{ route('sanpham.destroy', $item->MaSP) }}"
                                                method="POST" style="display:inline-block;"
                                                onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                        <td><img src="{{URL($item->AnhSP)}}" class="w-100" alt=""></td>
                                        <td>{{$item->TenSP}}</td>
                                        <td>{{$item->GioiTinh}}</td>
                                        <td>{{$item->ThuongHieu}}</td>
                                        <td>{{$item->loaiSanPham->TenLoai}}</td>
                                        <td>{{$item->doMatKinh->DoMatTrai}} : {{$item->doMatKinh->DoMatPhai}}</td>
                                        <td>{{$item->thongSoGong->TenCLG}}</td>
                                        <td>{{$item->thongSoTrong->TenCLT}}</td>
                                        <td>{{$item->GiaBan}}</td>
                                        <td>{{$item->SoLuongTonKho}}</td>
                                        <td>{{$item->MoTaChiTiet}}</td>
                                        <td>
                                            @if($item->TrangThaiSP == 1)
                                                Còn hàng
                                            @else
                                                Chưa có hàng
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
@endsection