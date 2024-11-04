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
                    <h5 class="card-title">Thêm thông số gọng</h5>
                    <form action="{{ route('thongsogong.create') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="row mb-3">
                            <label for="TenCLG" class="col-sm-2 col-form-label">Tên CLG</label>
                            <div class="col-sm-10">
                                <input type="text" name="TenCLG" id="TenCLG" value="" class="form-control">
                                @if ($errors->has('TenCLG'))
                                    <span class="text-danger">{{ $errors->first('TenCLG') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="MauGong" class="col-sm-2 col-form-label">Màu gọng</label>
                            <div class="col-sm-10">
                                <input type="color" name="MauGong" id="MauGong" value="" class="form-control">
                                @if ($errors->has('MauGong'))
                                    <span class="text-danger">{{ $errors->first('MauGong') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ChieuDaiGongKinh" class="col-sm-2 col-form-label">Chiều dài gọng kính</label>
                            <div class="col-sm-10">
                                <span>Đơn vị: mm</span>
                                <input type="number" step="1" min="130" max="155" name="ChieuDaiGongKinh" id="ChieuDaiGongKinh" value="" class="form-control">
                                @if ($errors->has('ChieuDaiGongKinh'))
                                    <span class="text-danger">{{ $errors->first('ChieuDaiGongKinh') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ChieuRongGongKinh" class="col-sm-2 col-form-label">Chiều rộng gọng kính</label>
                            <div class="col-sm-10">
                                <input type="number" step="1" min="120" max="160" name="ChieuRongGongKinh" id="ChieuRongGongKinh" value="" class="form-control">
                                @if ($errors->has('ChieuRongGongKinh'))
                                    <span class="text-danger">{{ $errors->first('ChieuRongGongKinh') }}</span>
                                @endif
                            </div>
                        </div>div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Cập nhật</label>
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