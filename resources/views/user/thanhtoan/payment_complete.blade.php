@extends('user.index')

@section('content')
<!-- Hiển thị thông báo nếu có -->

<div class="row mt-5 justify-content-center">
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
    <div class="col-4 text-center" style="padding: 30px">
        <div class="alert alert-success" role="alert" style="padding: 60px">
            <i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i>
            <span class="ms-2">{{ translateText('Vui lòng đợi admin kiểm tra.')}}</span>
        </div>
    </div>
</div>
@endsection