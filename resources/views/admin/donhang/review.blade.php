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
                    <h5 class="card-title">Đơn hàng</h5>
                    <a href="{{ route('domatkinh.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>
                    <!-- Table with stripped rows -->
                    <div style="overflow-x: auto">
                        @if (!empty($dh) && count($dh) > 0)
                            @php    $index = 1; @endphp
                            @foreach ($dh as $donHang)
                                <form action="{{ route('donhang.updateStatus', $donHang->MaDH) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Sử dụng PUT để cập nhật đơn hàng -->
                                    <table class="table table-bordered" style="table-layout: auto; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th colspan="8">
                                                    <strong>Mã đơn hàng:</strong> {{ $donHang->MaDH }}
                                                    <strong>Trạng thái hiện tại:</strong>
                                                    <select name="TrangThaiDonHang" class="form-control">
                                                        <option value="Chờ thanh toán" {{ $donHang->TrangThaiDonHang == 'Chờ thanh toán' ? 'selected' : '' }}>Chờ thanh toán</option>
                                                        <option value="Chờ vận chuyển" {{ $donHang->TrangThaiDonHang == 'Chờ vận chuyển' ? 'selected' : '' }}>Chờ vận chuyển</option>
                                                        <option value="Chờ giao hàng" {{ $donHang->TrangThaiDonHang == 'Chờ giao hàng' ? 'selected' : '' }}>Chờ giao hàng</option>
                                                        <option value="Chưa đánh giá" {{ $donHang->TrangThaiDonHang == 'Chưa đánh giá' ? 'selected' : '' }}>Chưa đánh giá</option>
                                                        <option value="Đã hủy" {{ $donHang->TrangThaiDonHang == 'Đã hủy' ? 'selected' : '' }}>Đã hủy
                                                        </option>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>STT</th>
                                                <th>Ảnh SP</th>
                                                <th>Tên SP</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                                <th>Ngày đặt</th>
                                                <th>Ngày hủy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donHang->sanPhams as $sp)
                                                    @php
                                                        //$product = \App\Models\SanPham::where('MaSP', $sp->MaSP)->first();
                                                        if ($donHang->TrangThaiDonHang != "Đã hủy") {
                                                            $total += $sp->pivot->DonGia * $sp->pivot->SoLuongSP;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td>
                                                            <img src="{{ asset($sp->AnhSP) }}" width="50" height="50" alt="{{ $sp->TenSP }}">
                                                        </td>
                                                        <td>{{ $sp->TenSP }}</td>
                                                        <td>{{ $sp->pivot->SoLuongSP }}</td> <!-- Lấy từ bảng trung gian -->
                                                        <td>{{ number_format($sp->pivot->DonGia, 0, ',', '.') }} ₫</td> <!-- Đơn giá từ bảng trung gian -->
                                                        <td>{{ number_format($sp->pivot->ThanhTien, 0, ',', '.') }} ₫</td>
                                                        <td>
                                                            @if ($donHang->NgayDatDH instanceof \Carbon\Carbon)
                                                                {{ $donHang->NgayDatDH->format('d/m/Y') }}
                                                            @else
                                                                {{ $donHang->NgayDatDH }} <!-- In ra giá trị để kiểm tra -->
                                                            @endif
                                                        </td> <!-- Ngày đặt hàng -->
                                                        <td>
                                                            @if ($donHang->NgayHuyDH instanceof \Carbon\Carbon)
                                                                {{ $donHang->NgayHuyDH->format('d/m/Y') }}
                                                            @else
                                                                {{ $donHang->NgayHuyDH }} <!-- In ra giá trị để kiểm tra -->
                                                            @endif
                                                        </td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <h4>Tổng tiền: <span id="total-price">{{ number_format($total, 0, ',', '.') }} ₫</span></h4>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
                                    </div>
                                </form>
                            @endforeach
                        @else
                            <p>Đơn hàng đang trống.</p>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection