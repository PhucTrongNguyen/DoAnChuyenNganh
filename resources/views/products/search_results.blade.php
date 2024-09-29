@extends('Layout.app')

@section('content')
<div class="container container-content">
    <h1>Kết quả tìm kiếm</h1>
    @if ($products->isEmpty())
        <p>Không có sản phẩm nào được tìm thấy.</p>
    @else
        <div class="list-group">
            @foreach ($products as $product)
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $product->name }}</h5>
                        <small class="text-muted">{{ $product->created_at->format('d/m/Y') }}</small>
                    </div>
                    <p class="mb-1">{{ $product->picture }}</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
