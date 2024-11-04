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
                    <h5 class="card-title">Cập nhật thương hiệu</h5>
                    <form action="{{ route('thuonghieu.update', $th->MaTH) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="TenTH" class="col-sm-2 col-form-label">Tên TH</label>
                            <div class="col-sm-10">
                                <input type="text" name="TenTH" id="TenTH" value="{{$th->TenTH}}" class="form-control">
                                @if ($errors->has('TenTH'))
                                    <span class="text-danger">{{ $errors->first('TenTH') }}</span>
                                @endif
                            </div>
                        </div>
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