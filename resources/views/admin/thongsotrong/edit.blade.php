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
                    <h5 class="card-title">Cập nhật thông số tròng</h5>
                    <form action="{{ route('thongsotrong.update', $tr->MaCLT) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="TenCLT" class="col-sm-2 col-form-label">Tên CLT</label>
                            <div class="col-sm-10">
                                <input type="text" name="TenCLT" id="TenCLT" value="{{$tr->TenCLT}}" class="form-control">
                                @if ($errors->has('TenCLT'))
                                    <span class="text-danger">{{ $errors->first('TenCLT') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="MauTrong" class="col-sm-2 col-form-label">Màu tròng</label>
                            <div class="col-sm-10">
                                <input type="color" name="MauTrong" id="MauTrong" value="{{$dc->MauTrong}}" class="form-control">
                                @if ($errors->has('MauTrong'))
                                    <span class="text-danger">{{ $errors->first('MauTrong') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="DoRongTrong" class="col-sm-2 col-form-label">Độ rộng tròng</label>
                            <div class="col-sm-10">
                                <input type="number" step="1" min="40" max="65" name="DoRongTrong" id="DoRongTrong" value="{{$dc->DoRongTrong}}" class="form-control">
                                @if ($errors->has('DoRongTrong'))
                                    <span class="text-danger">{{ $errors->first('DoRongTrong') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="DoCaoTrong" class="col-sm-2 col-form-label">Độ cao tròng</label>
                            <div class="col-sm-10">
                                <input type="text" step="1" min="30" max="55" name="DoCaoTrong" id="DoCaoTrong" value="{{$dc->DoCaoTrong}}" class="form-control">
                                @if ($errors->has('DoCaoTrong'))
                                    <span class="text-danger">{{ $errors->first('DoCaoTrong') }}</span>
                                @endif
                            </div>
                        </div>
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