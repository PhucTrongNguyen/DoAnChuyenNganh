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
                        <h5>{{ translateText('Thông tin sản phẩm')}}</h5>
                        <p>{{ translateText('Loại')}}: <strong class="card-category"></strong></p>
                        <p>{{ translateText('Tên')}}: <strong class="card-title"></strong></p>
                        <p>{{ translateText('Giá')}}: <strong class="card-money"></strong></p>
                        <p>{{ translateText('Trạng thái')}}:
                            <strong class="badge card-status"></strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Product Listings -->
            <div class="col-lg-8">
                <div id="product-list">
                    @include('user.sanpham.product-list', ['sp' => $sp])
                </div>
                <div class="pagination-links">
                    @include('user.sanpham.pagination', ['sp' => $sp])
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
                                        <div class="card" style="display: flex; flex-direction: column; height: 100%;">
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

    $(document).ready(function() {
        var productIndex = 0;
        var products = $('#product-list .card'); // Lấy danh sách các sản phẩm
        var totalProducts = products.length; // Tổng số sản phẩm

        // Hàm hiển thị chi tiết sản phẩm
        async function showProductDetails(index) {
            var product = $(products[index]);
            var productImage = product.find('.card-img-top').attr('src');
            var productTitle = product.find('.card-text').text();
            var productPrice = product.find('.card-title').text();
            var productCategory = product.find('.card-category').text();
            var productStatus = product.find('.out-of-stock-text').length > 0 ? 'Hết hàng' : 'Còn hàng';

            // Cập nhật nội dung chi tiết sản phẩm
            $('#chitietsanpham img').attr('src', productImage);
            $('#chitietsanpham .card-title').text(productTitle);
            $('#chitietsanpham .card-money').text(productPrice);
            $('#chitietsanpham .card-category').text(productCategory);

            var badgeElement = document.querySelector('#chitietsanpham .badge');
            if (badgeElement) {
                badgeElement.textContent = productStatus;
                badgeElement.classList.remove('bg-success', 'bg-danger');
                badgeElement.classList.add(productStatus == "Còn hàng" ? 'bg-success' : 'bg-danger');
            } else {
                console.error('Không tìm thấy thẻ .badge trong DOM.');
            }


            // Hiển thị thẻ chi tiết sản phẩm (có thể thêm hiệu ứng mượt mà nếu muốn)
            $('#chitietsanpham').show();
        }

        // Thiết lập tự động hiển thị lần lượt sản phẩm sau mỗi 3 giây
        setInterval(function() {
            showProductDetails(productIndex);
            productIndex++; // Tăng chỉ số sản phẩm
            if (productIndex >= totalProducts) {
                productIndex = 0; // Quay lại sản phẩm đầu tiên nếu hết danh sách
            }
        }, 3000); // 3 giây chuyển sản phẩm
    });

</script>

@endsection