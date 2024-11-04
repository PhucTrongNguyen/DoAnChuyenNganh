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
                    <h5 class="card-title">General Form Elements</h5>
                    <form action="{{ route('sanpham.store') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tên SP</label>
                            <div class="col-sm-10">
                                <input type="text" name="TenSP" id="TenSP" class="form-control">
                                @if ($errors->has('TenSP'))
                                    <span class="text-danger">{{ $errors->first('TenSP') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Giá bán</label>
                            <div class="col-sm-10">
                                <input type="number" name="GiaBan" id="GiaBan" class="form-control">
                                @if ($errors->has('GiaBan'))
                                    <span class="text-danger">{{ $errors->first('GiaBan') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Số lượng tồn kho</label>
                            <div class="col-sm-10">
                                <input type="number" name="SoLuongTonKho" id="SoLuongTonKho" class="form-control">
                                @if ($errors->has('SoLuongTonKho'))
                                    <span class="text-danger">{{ $errors->first('SoLuongTonKho') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="AnhSP" class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <input class="form-control {{ $errors->has('AnhSP') ? 'is-invalid' : '' }}" name="AnhSP" id="AnhSP" type="file" id="formFile">
                                @if ($errors->has('AnhSP'))
                                    <span class="text-danger">{{ $errors->first('AnhSP') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="MoTaChiTiet" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="MoTaChiTiet" id="MoTaChiTiet" style="height: 100px"></textarea>
                                @if ($errors->has('MoTaChiTiet'))
                                    <span class="text-danger">{{ $errors->first('MoTaChiTiet') }}</span>
                                @endif
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Dành cho</legend>
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
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Trạng thái</legend>
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
                            <label class="col-sm-2 col-form-label">Thương hiệu</label>
                            <div class="col-sm-10">
                                <select class="form-select {{ $errors->has('ThuongHieu') ? 'is-invalid' : '' }}" name="ThuongHieu" id="ThuongHieu"
                                    aria-label="Default select example">
                                    <option value="" selected>Chọn thương hiệu</option>
                                    @foreach ($th as $item)
                                        <option value="{{$item->MaTH}}" {{ old('ThuongHieu') == $item->MaTH ? 'selected' : '' }}>{{$item->TenTH}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ThuongHieu'))
                                    <span class="text-danger">{{ $errors->first('ThuongHieu') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Loại mắt kính</label>
                            <div class="col-sm-10">
                                <select class="form-select {{ $errors->has('LoaiMatKinh') ? 'is-invalid' : '' }}" name="LoaiMatKinh" id="LoaiMatKinh"
                                    aria-label="Default select example">
                                    <option value="" selected>Chọn loại mắt kính</option>
                                    @foreach ($lmk as $item)
                                        <option value="{{$item->MaLoai}}" {{ old('LoaiMatKinh') == $item->MaLoai ? 'selected' : '' }}>{{$item->TenLoai}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('LoaiMatKinh'))
                                    <span class="text-danger">{{ $errors->first('LoaiMatKinh') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Do" class="col-sm-2 col-form-label">Độ mắt kính</label>
                            <div class="col-sm-10">
                                <select class="form-select {{ $errors->has('Do') ? 'is-invalid' : '' }}" name="Do" id="Do">
                                    <option value="" selected>Chọn độ mắt kính</option>
                                    @foreach ($do as $item)
                                        <option value="{{ $item->MaDo }}" {{ old('Do') == $item->MaDo ? 'selected' : '' }}>
                                            {{ $item->DoMatTrai }} : {{$item->DoMatPhai}}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('Do'))
                                    <span class="text-danger">{{ $errors->first('Do') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Chất liệu gọng</label>
                            <div class="col-sm-10">
                                <select class="form-select {{ $errors->has('MaCLG') ? 'is-invalid' : '' }}" name="MaCLG" id="selectGong"
                                    aria-label="Default select example">
                                    <option value="" selected>Chọn chất liệu gọng</option>
                                    @foreach ($tsg as $item)
                                        <option value="{{$item->MaCLG}}" {{ old('MaCLG') == $item->MaCLG ? 'selected' : '' }} data-mau="{{$item->MauGong}}"
                                            data-dai="{{$item->ChieuDaiGongKinh}}" data-rong="{{$item->ChieuRongGongKinh}}">
                                            {{$item->TenCLG}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('MaCLG'))
                                    <span class="text-danger">{{ $errors->first('MaCLG') }}</span>
                                @endif
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Thông số gọng</legend>
                            <div class="col-sm-10">
                                <label for="inputColor" class="col-sm-2 col-form-label">Màu gọng</label>
                                <div class="col-sm-10">
                                    <input type="color" id="inputMauGong" class="form-control form-control-color"
                                        id="exampleColorInput" value="#3498db" title="Choose your color" disabled>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Chiều dài gọng kính</label>
                                <div class="col-sm-10">
                                    <input type="text" id="inputChieuDai" class="form-control" disabled>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Chiều rộng gọng kính</label>
                                <div class="col-sm-10">
                                    <input type="text" id="inputChieuRong" class="form-control" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Chất liệu tròng</label>
                            <div class="col-sm-10">
                                <select class="form-select {{ $errors->has('MaCLT') ? 'is-invalid' : '' }}" name="MaCLT" id="selectTrong"
                                    aria-label="Default select example">
                                    <option value="" selected>Chọn chất liệu tròng</option>
                                    @foreach ($tst as $item)
                                        <option value="{{$item->MaCLT}}" {{ old('MaCLT') == $item->MaCLT ? 'selected' : '' }} data-mau="{{$item->MauTrong}}"
                                            data-cao="{{$item->DoCaoTrong}}" data-rong="{{$item->DoRongTrong}}">
                                            {{$item->TenCLT}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('MaCLT'))
                                    <span class="text-danger">{{ $errors->first('MaCLT') }}</span>
                                @endif
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Thông số tròng</legend>
                            <div class="col-sm-10">
                                <label for="inputColor" class="col-sm-2 col-form-label">Màu tròng</label>
                                <div class="col-sm-10">
                                    <input type="color" id="inputMauTrong" class="form-control form-control-color"
                                        id="exampleColorInput" value="#4154f1" title="Choose your color" disabled>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Độ cao tròng kính</label>
                                <div class="col-sm-10">
                                    <input type="text" id="inputDoCao" class="form-control" disabled>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">Độ rộng tròng kính</label>
                                <div class="col-sm-10">
                                    <input type="text" id="inputDoRong" class="form-control" disabled>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nhà cung cấp</label>
                            <div class="col-sm-10">
                                <select class="form-select {{ $errors->has('MaNCC') ? 'is-invalid' : '' }}" name="MaNCC" id="MaNCC" aria-label="Default select example">
                                    <option value="" selected>Chọn nhà cung cấp</option>
                                    @foreach ($ncc as $item)
                                        <option value="{{$item->MaNCC}}" {{ old('MaNCC') == $item->MaNCC ? 'selected' : '' }}>{{$item->TenNCC}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('MaNCC'))
                                    <span class="text-danger">{{ $errors->first('MaNCC') }}</span>
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