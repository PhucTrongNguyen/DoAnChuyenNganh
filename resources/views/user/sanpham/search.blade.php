@extends('user.index')

@section('content')
@php
    use App\Helpers\CurrencyHelper;
    $selectedLocale = session('locale', 'vi-VN');

    // Bản đồ ngôn ngữ với đơn vị tiền tệ
    $currencyMap = [
        'en' => 'USD',
        'vi' => 'VND',
        'ja' => 'JPY',
    ];

    // Xác định đơn vị tiền tệ dựa trên ngôn ngữ
    $selectedCurrency = $currencyMap[$selectedLocale] ?? 'VND';
@endphp
<div class="container mt-5">
    <h2>Kết quả tìm kiếm</h2>
    @if (isset($products) && $products->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach ($products as $item)
                <div class="col">
                    <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                        <div class="image-container" style="position: relative; height: 250px; overflow: hidden;">
                            <img src="{{ asset($item->AnhSP)}}" class="card-img-top" alt="{{ $item->TenSP }}" id="product-image"
                                style="width: 100%; object-fit: cover;">
                            <img src="{{$item->AnhSP}}" class="card-img-top {{ $item->TrangThaiSP == 0 ? 'out-of-stock' : '' }}"
                                alt="{{ $item->TenSP }}" id="product-image" style="width: 100%; object-fit: cover;">

                            @if($item->TrangThaiSP == 0)
                                <div class="out-of-stock-text">{{ translateText('Hết Hàng')}}</div>
                            @endif
                            <div class="image-overlay">
                                @include('user.layout.functions', ['item' => $item])
                            </div>
                        </div>
                        <div class="card-body" id="product-list"
                            style="flex-grow: 1; display: flex; flex-direction: column; justify-content: flex-end;">
                            <h5 class="card-title">
                                {{ CurrencyHelper::formatCurrency($item->GiaBan, $selectedCurrency, $selectedLocale) }}
                            </h5>
                            <p class="card-text">{{ translateText($item->TenSP)}}</p>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            {{ translateText('Không tìm thấy sản phẩm')}}
        </div>
    @endif
</div>
@endsection