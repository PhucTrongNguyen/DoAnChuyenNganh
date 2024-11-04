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
                    <h5 class="card-title">Cập nhật địa chỉ</h5>
                    <form action="{{ route('diachi.update', $dc->MaDC) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="LoaiDC" class="col-sm-2 col-form-label">Loại địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" name="LoaiDC" id="LoaiDC" value="{{$dc->LoaiDC}}" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ThongTinDC" class="col-sm-2 col-form-label">Thông tin địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" name="ThongTinDC" id="ThongTinDC" value="{{$dc->ThongTinDC}}" class="form-control">
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