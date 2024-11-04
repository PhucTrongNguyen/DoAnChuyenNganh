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
    <h1>Form Elements</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Elements</li>
        </ol>
    </nav>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tạo thêm người quản lý</h5>
                    <form action="{{ route('nguoiquanly.store') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="row mb-3">
                            <label for="TenQL" class="col-sm-2 col-form-label">Tên QL</label>
                            <div class="col-sm-10">
                                <input type="text" name="TenQL" id="TenQL" class="form-control">
                                @if ($errors->has('TenQL'))
                                    <span class="text-danger">{{ $errors->first('TenQL') }}</span>
                                @endif
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Giới tính</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="GioiTinh" id="GioiTinh"
                                        value="Nam" checked>
                                    <label class="form-check-label" for="GioiTinh">
                                        Nam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="GioiTinh" id="GioiTinh"
                                        value="Nữ">
                                    <label class="form-check-label" for="GioiTinh">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row mb-3">
                            <label for="Email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="Email" id="Email" class="form-control">
                                @if ($errors->has('Email'))
                                    <span class="text-danger">{{ $errors->first('Email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="MatKhau" class="col-sm-2 col-form-label">Mật khẩu</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="MatKhau" id="MatKhau">
                                @if ($errors->has('MatKhau'))
                                    <span class="text-danger">{{ $errors->first('MatKhau') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ChucVu" class="col-sm-2 col-form-label">Chức vụ</label>
                            <div class="col-sm-10">
                                <select class="form-select {{ $errors->has('ChucVu') ? 'is-invalid' : '' }}" name="ChucVu" id="ChucVu"
                                    aria-label="Default select example">
                                    <option value="" selected>Chọn chức vụ</option>
                                    <option value="Quản lý" {{ old('ChucVu') == 'Quản lý' ? 'selected' : '' }}>Quản lý</option>
                                    <option value="Nhân viên" {{ old('ChucVu') == 'Nhân viên' ? 'selected' : '' }}>Nhân viên</option>
                                </select>
                                @if ($errors->has('ChucVu'))
                                    <span class="text-danger">{{ $errors->first('ChucVu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="DiaChi" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="DiaChi" id="DiaChi">
                                @if ($errors->has('DiaChi'))
                                    <span class="text-danger">{{ $errors->first('DiaChi') }}</span>
                                @endif
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Trạng thái tài khoản</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="TrangThaiSP" id="TrangThaiSP"
                                        value="1" checked>
                                    <label class="form-check-label" for="TrangThaiSP">
                                        Có hàng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="TrangThaiSP" id="TrangThaiSP"
                                        value="0">
                                    <label class="form-check-label" for="TrangThaiSP">
                                        Chưa có hàng
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Thêm</label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection