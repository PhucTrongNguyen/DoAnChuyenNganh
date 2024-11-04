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
                    <h5 class="card-title">Cập nhật nhà cung cấp</h5>
                    <form action="{{ route('nhacungcap.update', $ncc->MaNCC) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="row mb-3">
                            <label for="TenNCC" class="col-sm-2 col-form-label">Tên NCC</label>
                            <div class="col-sm-10">
                                <input type="text" name="TenNCC" id="TenNCC" value="{{$ncc->TenNCC}}" class="form-control">
                                @if ($errors->has('TenNCC'))
                                    <span class="text-danger">{{ $errors->first('TenNCC') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="DiaChiNCC" class="col-sm-2 col-form-label">Địa chỉ NCC</label>
                            <div class="col-sm-10">
                                <input type="text" name="DiaChiNCC" id="DiaChiNCC" value="{{$ncc->DiaChiNCC}}" class="form-control">
                                @if ($errors->has('DiaChiNCC'))
                                    <span class="text-danger">{{ $errors->first('DiaChiNCC') }}</span>
                                @endif
                            </div>
                        </div>div>
                        <div class="row mb-3">
                            <label for="MoTa" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea name="MoTa" id="MoTa" maxlength="2000" rows="10" class="form-control">{{$ncc->MoTa}}</textarea>
                                @if ($errors->has('MoTa'))
                                    <span class="text-danger">{{ $errors->first('MoTa') }}</span>
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