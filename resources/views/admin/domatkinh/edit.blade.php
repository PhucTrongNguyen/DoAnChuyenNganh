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
                    <h5 class="card-title">Cập nhật độ mắt kính</h5>
                    <form action="{{ route('domatkinh.update', $dmk->MaDo) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="DoMatTrai" class="col-sm-2 col-form-label">Độ mắt trái</label>
                            <div class="col-sm-10">
                                <input type="number" step="0.1" min="0" max="10" name="DoMatTrai" id="DoMatTrai" value="{{$dmk->DoMatTrai}}" class="form-control">
                                @if ($errors->has('DoMatTrai'))
                                    <span class="text-danger">{{ $errors->first('DoMatTrai') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="DoMatPhai" class="col-sm-2 col-form-label">Độ mắt phải</label>
                            <div class="col-sm-10">
                                <input type="number" step="0.1" min="0" max="10" name="DoMatPhai" id="DoMatPhai" value="{{$dmk->DoMatPhai}}" class="form-control">
                                @if ($errors->has('DoMatPhai'))
                                    <span class="text-danger">{{ $errors->first('DoMatPhai') }}</span>
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