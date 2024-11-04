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
@if (!empty($kh) && count($kh) > 0)
@php    $index = 1; @endphp
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Khách hàng</h5>
                    <!-- <a href="{{ route('sanpham.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a> -->
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        <table class="table datatable" style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên KH</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Mật khẩu</th>
                                    <th>Google_ID</th>
                                    <th>Địa chỉ</th>
                                    <th>Điểm tích luỹ</th>
                                    <th>Trạng thái tài khoản</th>
                                    <th>Lần đăng nhập gần nhất</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kh as $item)
                                    <tr>
                                        <td>{{index++}}</td>
                                        <td><img src="{{$item->TenKH}}" alt=""></td>
                                        <td>{{$item->GioiTinh}}</td>
                                        <td>{{$item->NgaySinh}}</td>
                                        <td>{{$item->Email}}</td>
                                        <td>{{$item->DienThoai}}</td>
                                        <td>{{$item->MatKhau}}</td>
                                        <td>{{$item->Google_id}}</td>
                                        <td>
                                            @foreach ($kh->diaChis as $diachi)
                                            @if ($diachi->LoaiDC == "Địa chỉ giao hàng")
                                            Địa chỉ giao hàng: {{$diachi->ThongTinDC}}<br>
                                            @else
                                            Địa chỉ khác: {{$diachi->ThongTinDC}}<br>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>{{$item->DiemTichLuy}}</td>
                                        <td>
                                            @if ($item->TrangThaiTK == 1)
                                            <span class="badge bg-success">Kích hoạt</span>
                                            @else
                                            <span class="badge bg-danger">Dừng</span>
                                            @endif
                                        </td>
                                        <td>{{$item->LanDangNhapGanNhat}}</td>
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