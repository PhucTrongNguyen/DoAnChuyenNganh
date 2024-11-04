@extends('user.index')

@section('content')

@php
    // Lấy danh sách yêu thích từ session
    $favorites = session()->get('favorites', []);
@endphp
<?php 
    $productsChunk = $hot->chunk(4); // Mỗi nhóm gồm 4 sản phẩm
?>
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
<!-- Hiển thị sản phẩm bình thường, không có thông tin giỏ hàng hoặc yêu thích -->
<div class="container-content">
    <!-- Main Content -->
    <main class="container mt-4">
        <!-- Featured Image -->
        @include('user.layout.banner')

        <!-- Deals of the Week -->
        <section class="deals row mb-4">
            <div class="col-lg-4">
                <div class="card" id="chitietsanpham">
                    <img src="" class="card-img-top" alt="Deal product">
                    <div class="card-body">
                        @if (function_exists('translateText'))
                        <h5>{{translateText('Chi tiết sản phẩm')}}</h5>
                        @endif
                        <h5>{{ translateText('Chi tiết sản phẩm')}}</h5>
                        <p>{{ translateText('Loại SP')}}: <strong class="card-category"></strong></p>
                        <p>{{ translateText('Tên SP')}}: <strong class="card-title"></strong></p>
                        <p>{{ translateText('Giá bán')}}: <strong class="card-money"></strong></p>
                        <p>{{ translateText('Trạng thái')}}:
                            <strong class="badge"></strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Product Listings -->
            <div class="col-lg-8">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="feat-tab" data-bs-toggle="tab" data-bs-target="#feat"
                            type="button" role="tab" aria-controls="feat"
                            aria-selected="true">{{ translateText('Featured')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale" type="button"
                            role="tab" aria-controls="sale"
                            aria-selected="false">{{ translateText('Best sale')}}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="best-tab" data-bs-toggle="tab" data-bs-target="#best" type="button"
                            role="tab" aria-controls="best"
                            aria-selected="false">{{ translateText('Best Rated')}}</button>
                    </li>
                </ul>

                <div class="tab-content" id="productTabContent">

                    <!-- Featured Products -->
                    <div class="tab-pane fade show active" id="feat" role="tabpanel" aria-labelledby="feat-tab">
                        <div id="product-list">
                            @include('user.sanpham.product-list', ['sp' => $sp])
                        </div>
                        <div class="pagination-links">
                            @include('user.sanpham.pagination', ['sp' => $sp])
                        </div>

                    </div>

                    <!-- Best Sale Products -->
                    <div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="sale-tab">
                        <div id="product-list">
                            @include('user.sanpham.product-list', ['sp' => $sp])
                        </div>
                        <div class="pagination-links">
                            @include('user.sanpham.pagination', ['sp' => $sp])
                        </div>
                    </div>

                    <!-- Best Rated Products -->
                    <div class="tab-pane fade" id="best" role="tabpanel" aria-labelledby="best-tab">
                        <div id="product-list">
                            @include('user.sanpham.product-list', ['sp' => $sp])
                        </div>
                        <div class="pagination-links">
                            @include('user.sanpham.pagination', ['sp' => $sp])
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hot New Arrivals Section -->
        <section>
            <h2>{{ translateText('Hot New Arrivals')}}</h2>
            <div id="carouselSanPham" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($productsChunk as $key => $products)
                        <div class="carousel-item @if($key == 0) active @endif">
                            <div class="row row-cols-2 row-cols-md-4 g-4 mt-3">
                                @foreach($products as $item)
                                    <div class="col">
                                        <div class="card">
                                            <div class="image-container">
                                                <img src="{{$item->AnhSP}}" data-id="{{$item->MaSP}}"
                                                    class="card-img-top product-img" alt="{{ $item->TenSP }}">
                                                <div class="image-overlay">
                                                    @include('user.layout.functions', ['item' => $item])
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ CurrencyHelper::formatCurrency($item->GiaBan, $selectedCurrency, $selectedLocale) }}</h5>
                                                <p class="card-text">{{ translateText($item->TenSP)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselSanPham"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselSanPham"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


        </section>
        <!-- @include('user.sanpham.pagination') -->
    </main>
</div>

<script>
    document.getElementById('languageSelect').addEventListener('change', function () {
        // Lấy giá trị ngôn ngữ được chọn
        const selectedLanguage = this.value;

        // Gửi yêu cầu POST tới Laravel để thay đổi ngôn ngữ (session)
        fetch('{{ route('change.language') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                language: selectedLanguage
            })
        })
            .then(response => response.json())
            .then(data => {
                // Ngôn ngữ đã thay đổi thành công, thực hiện dịch thuật trên giao diện
                document.querySelectorAll('[data-translate]').forEach(async (element) => {
                    const originalText = element.getAttribute('data-translate');
                    const translatedText = await translateText(originalText, selectedLanguage);
                    element.textContent = translatedText;
                });
            })
            .catch(error => console.error('Error:', error));
    });

    async function translateText(text, targetLanguage) {
        const apiUrl = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${targetLanguage}&dt=t&q=${encodeURIComponent(text)}`;

        try {
            const response = await fetch(apiUrl);
            const result = await response.json();
            return result[0][0][0];  // Trả về văn bản đã dịch
        } catch (error) {
            console.error('Error translating text:', error);
            return text;  // Nếu lỗi, trả về văn bản gốc
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const productIDs = @json($sp->pluck('MaSP'));

        let currentIndex = 0;
        async function loadProductDetails() {
            try {
                if (currentIndex >= productIDs.length) {
                    return; // Kết thúc nếu đã xử lý hết sản phẩm
                }

                const MaSP = productIDs[currentIndex];
                // Gọi API để lấy dữ liệu sản phẩm
                const response = await fetch(`/sanpham/${MaSP}`);
                const product = await response.json();

                // Dùng async/await để đợi hàm translateText trả về
                const translatedName = await translateText(product.TenSP, '{{ session('locale', 'vi') }}');
                const translatedStatus = await translateText(product.TrangThaiSP == 1 ? 'Còn hàng' : 'Hết hàng', '{{ session('locale', 'vi') }}');
                const translatedCategory = await translateText(product.LoaiSP, '{{ session('locale', 'vi') }}')

                // Cập nhật chi tiết sản phẩm vào khung chi tiết
                document.querySelector('#chitietsanpham .card-img-top').src = product.AnhSP;
                document.querySelector('#chitietsanpham .card-title').textContent = translatedName;
                document.querySelector('#chitietsanpham .badge').textContent = translatedStatus;
                document.querySelector('#chitietsanpham .badge').classList.remove('bg-success', 'bg-danger');
                document.querySelector('#chitietsanpham .badge').classList.add(product.TrangThaiSP == 1 ? 'bg-success' : 'bg-danger');
                document.querySelector('#chitietsanpham .card-category').textContent = translatedCategory;

                // Định dạng giá tiền
                const selectedLocale = '{{ session('locale', 'vi-VN') }}';
                const currencyMap = {
                    'en': 'USD',
                    'vi': 'VND',
                    'ja': 'JPY',
                };
                const selectedCurrency = currencyMap[selectedLocale] || 'VND';
                const formattedPrice = new Intl.NumberFormat(selectedLocale, {
                    style: 'currency',
                    currency: selectedCurrency
                }).format(product.GiaBan);

                document.querySelector('#chitietsanpham .card-money').textContent = formattedPrice;

                // Sau khi tải xong sản phẩm hiện tại, tải sản phẩm tiếp theo
                currentIndex++;
                setTimeout(loadProductDetails, 5000);  // Chờ 5 giây trước khi tải sản phẩm tiếp theo
            } catch (error) {
                console.error('Error loading product:', error);
            }
        }

        // Gọi hàm loadProductDetails với mã sản phẩm
        loadProductDetails();

    })

</script>

@endsection