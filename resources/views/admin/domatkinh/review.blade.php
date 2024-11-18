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
    @if (!empty($dmk) && count($dmk) > 0)
            @php    $index = 1; @endphp
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Độ mắt kính</h5>
                            <a href="{{ route('domatkinh.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>
                            <!-- Table with stripped rows -->
                            <div style="overflow-x: auto">
                                <table class="table datatable" style="table-layout: auto; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Thao tác</th>
                                            <th>STT</th>
                                            <th>Độ mắt trái</th>
                                            <th>Độ mắt phải</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Ngày tạo</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Ngày sửa</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Ngày xoá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dmk as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('domatkinh.edit', $item->MaDo) }}"
                                                        class="btn btn-warning">Sửa</a>
                                                    <form action="{{ route('domatkinh.destroy', $item->MaDo) }}" method="POST"
                                                        style="display:inline-block;" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </td>
                                                <td>{{ $index++ }}</td>
                                                <td>{{$item->DoMatTrai}}</td>
                                                <td>{{$item->DoMatPhai}}</td>
                                                <td>{{$item->NgayTaoDo}}</td>
                                                <td>{{$item->NgaySuaDo}}</td>
                                                <td>{{$item->NgayXoaDo}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif
@endsection