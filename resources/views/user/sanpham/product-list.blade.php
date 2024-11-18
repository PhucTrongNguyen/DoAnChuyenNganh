<div class="row row-cols-2 row-cols-md-3 g-4">
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
    @foreach($sp as $item)
        <div class="col">
            <div class="card" data-id="{{ $item->MaSP }}" style="display: flex; flex-direction: column; height: 100%;">
                <div class="image-container" style="position: relative; height: 250px; overflow: hidden;">
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
                    <p class="card-category" style="display: none">{{ $item->loaiSanPham->TenLoai }}</p>
                    <p class="card-text">{{ translateText($item->TenSP)}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>