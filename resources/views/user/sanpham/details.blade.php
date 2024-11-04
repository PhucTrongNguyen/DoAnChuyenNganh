@extends('user.index')

@section('content')

<?php 
$productsChunk = $products->chunk(4); // Mỗi nhóm gồm 4 sản phẩm
?>

<div class="container mt-5">
    <h2>{{ Str::upper($product->TenSP) }}</h2>
    <div class="product-detail">
        <div class="row">
            <div class="col-md-6">
                <!-- Hình ảnh sản phẩm chính -->
                <img id="mainImage" style="border-radius: 8px" src="{{ asset($product->AnhSP) }}" class="img-fluid"
                    alt="{{ $product->TenSP }}">
            </div>
            <div class="col-md-6 d-flex justify-content-between align-items-start">
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <h5 class="mb-0">Tên sản phẩm: {{ $product->TenSP }}</h5>
                    <h5 class="mb-0">Giá: {{ number_format($product->GiaBan, 0, ',', '.') }} ₫</h5>
                    <!-- Mô tả sản phẩm -->
                    <h5 class="mb-0">Mô tả sản phẩm:</h5>
                    <p>{{ $product->MoTaChiTiet ?? 'Chưa có mô tả cho sản phẩm này.' }}</p>

                    @php
                        // Lấy danh sách yêu thích từ session
                        $favorites = session()->get('favorites', []);
                    @endphp
                    <!-- Form thêm vào giỏ hàng -->
                    <div class="mb-3 gap-3">
                        <label for="quantity{{ $product->MaSP }}" class="form-label">Số lượng</label>
                        <input type="number" name="quantity" id="quantity{{ $product->MaSP }}" class="form-control"
                            value="1" min="1" onchange="updateHiddenQuantity('{{ $product->MaSP }}')"
                            onkeydown="return false">
                    </div>

                    <!-- Input Thông số -->
                    <div class="mb-3 gap-3">
                        <label for="degree_of_glass{{ $product->MaSP }}" class="form-label">Thông số tròng</label>
                        <!-- <input type="text" name="degree_of_glass" class="form-control" placeholder="Nhập thông số"> -->
                        <div class="row">
                            <div class="col-4">
                                <label for="inputColor" class="">Màu tròng</label>
                                <input type="color" id="inputMauTrong" class="form-control form-control-color"
                                    id="exampleColorInput" value="{{$product->thongSoTrong->MauTrong}}"
                                    title="Choose your color" disabled>
                            </div>
                            <div class="col-4">
                                <label for="inputPassword" class="">Độ cao tròng kính</label>
                                <input type="text" id="inputDoCao" class="form-control"
                                    value="{{$product->thongSoTrong->DoCaoTrong}}" disabled>
                            </div>
                            <div class="col-4">
                                <label for="inputPassword" class="">Độ rộng tròng kính</label>
                                <input type="text" id="inputDoRong" class="form-control"
                                    value="{{$product->thongSoTrong->DoRongTrong}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 gap-3">
                        <label for="degree_of_glass{{ $product->MaSP }}" class="form-label">Thông số gọng</label>
                        <!-- <input type="text" name="degree_of_glass" class="form-control" placeholder="Nhập thông số"> -->
                        <div class="row">
                            <div class="col-4">
                                <label for="inputMauGong" class="">Màu gọng</label>
                                <input type="color" id="inputMauGong" class="form-control form-control-color"
                                    id="exampleColorInput" value="{{$product->thongSoGong->MauGong}}"
                                    title="Choose your color" disabled>
                            </div>
                            <div class="col-4">
                                <label for="inputChieuDai" class="">Chiều dài gọng kính</label>
                                <input type="text" id="inputChieuDai" class="form-control"
                                    value="{{$product->thongSoGong->ChieuDaiGongKinh}}" disabled>
                            </div>
                            <div class="col-4">
                                <label for="inputChieuRong" class="">Chiều rộng gọng kính</label>
                                <input type="text" id="inputChieuRong" class="form-control"
                                    value="{{$product->thongSoGong->ChieuRongGongKinh}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 gap-3">
                        <label for="degree_of_glass{{ $product->MaSP }}" class="form-label">Độ cận</label>
                        <!-- <input type="text" name="degree_of_glass" class="form-control" placeholder="Nhập thông số"> -->
                        <div class="row">
                            <div class="col-4">
                                <label for="inputMauGong" class="">Mắt trái</label>
                                <input type="text" id="inputMauGong" class="form-control"
                                    value="{{$product->doMatKinh->DoMatTrai}}" disabled>
                            </div>
                            <div class="col-4">
                                <label for="inputChieuDai" class="">Mắt phải</label>
                                <input type="text" id="inputChieuDai" class="form-control"
                                    value="{{$product->doMatKinh->DoMatPhai}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        @include('user.layout.functions', ['item' => $product])
                    </div>

                </div>

                <!-- Nút yêu thích -->
                <!-- <form
                    action="{{ in_array($product->MaSP, $favorites) ? route('favorite.remove', $product->MaSP) : route('favorite.add', $product->MaSP) }}"
                    method="POST" style="display: inline;" onsubmit="updateFavoriteCount()">
                    @csrf
                    @if (in_array($product->MaSP, $favorites))
                        @method('DELETE')
                        <button class="btn p-0 ms-2" type="submit" aria-label="Remove from wishlist">
                            <i class="bi bi-heart-fill" style="font-size: 1.5rem; color: red;"></i>
                        </button>
                    @else
                        <button class="btn p-0 ms-2" type="submit" aria-label="Add to wishlist">
                            <i class="bi bi-heart" style="font-size: 1.5rem; color: gray;"></i>
                        </button>
                    @endif
                </form> -->
            </div>
        </div>
    </div>
    <section>
        <h2>Sản phẩm cùng loại</h2>
        <div id="carouselExample" class="carousel slide">

            <div class="carousel-inner">
                @foreach($productsChunk as $key => $products)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <div class="row row-cols-2 row-cols-md-4 g-4 mt-3">
                            @foreach($products as $item)
                                <div class="col">
                                    <div class="card">
                                        <div class="image-container">
                                            <img src="{{asset($item->AnhSP)}}" data-id="{{$item->MaSP}}"
                                                class="card-img-top product-img" alt="{{ $item->TenSP }}">
                                            <div class="image-overlay">
                                                <form action="{{route('sanpham.details', $item->MaSP)}}" method="GET">
                                                    <button title="Chi tiết sản phẩm" type="submit" class="btn btn-light mx-1">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                    </button>
                                                </form>
                                                @if (session()->has('MaKH'))
                                                    <form id="cartForm{{ $item->MaSP }}"
                                                        action="{{ in_array($item->MaSP, $sanPhamTrongGH) ? route('cart.remove', $item->MaSP) : route('cart.add', $item->MaSP) }}"
                                                        method="POST"
                                                        onsubmit="event.preventDefault(); updateCart('{{ $item->MaSP }}');">
                                                        @csrf

                                                        <!-- Nếu đã đăng nhập, kiểm tra xem sản phẩm có trong giỏ hàng hay không -->
                                                        @if (in_array($item->MaSP, $sanPhamTrongGH))
                                                            @method('DELETE')
                                                            <button title="Thêm vào giỏ hàng" type="submit" class="btn btn-primary mx-1"
                                                                aria-label="Add from cartlist">
                                                                <i class="fa-solid fa-cart-shopping"></i>
                                                            </button>
                                                        @else
                                                            <input type="number" name="SoLuongSP" id="SoLuongSP" class="form-control"
                                                                value="1" min="1" hidden>
                                                            <button title="Xoá khỏi giỏ hàng" type="submit" class="btn btn-primary mx-1"
                                                                aria-label="Remove from cartlist">
                                                                <i class="fa-solid fa-cart-shopping"></i>
                                                            </button>
                                                        @endif
                                                    </form>
                                                @else
                                                    <!-- Nếu chưa đăng nhập, chỉ hiển thị nút thêm vào giỏ hàng nhưng không thực hiện hành động -->
                                                    <button title="Thêm vào giỏ hàng" type="submit" class="btn btn-primary mx-1"
                                                        aria-label="Add to cartlist" onclick="showLoginForm()">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </button>
                                                @endif

                                                @if (session()->has('MaKH'))
                                                    <form id="favoriteForm{{ $item->MaSP }}"
                                                        action="{{ in_array($item->MaSP, $soLuongSanPham) ? route('favorite.remove', $item->MaSP) : route('favorite.add', $item->MaSP) }}"
                                                        method="POST" style="display: inline;"
                                                        onsubmit="event.preventDefault(); updateFavorite('{{ $item->MaSP }}');">
                                                        @csrf
                                                        @if (in_array($item->MaSP, $soLuongSanPham))
                                                            @method('DELETE')
                                                            <button title="Xoá khỏi wishlist" class="btn btn-warning mx-1" type="submit"
                                                                aria-label="Remove from wishlist">
                                                                <i class="fa-solid fa-heart"></i>
                                                            </button>
                                                        @else
                                                            <button title="Thêm vào wishlist" class="btn btn-warning mx-1" type="submit"
                                                                aria-label="Add to wishlist">
                                                                <i class="fa-regular fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    </form>
                                                @else
                                                    <button title="Thêm vào wishlist" class="btn btn-warning mx-1" type="submit"
                                                        aria-label="Add to wishlist" onclick="showLoginForm()">
                                                        <i class="fa-regular fa-heart"></i>
                                                    </button>
                                                @endif
                                                <form id="image-form" method="post" enctype="multipart/form-data"
                                                    action="{{ route('run.python.script') }}">
                                                    @csrf
                                                    <input type="hidden" name="image_path" value="{{$item->AnhSP}}">
                                                    <button title="Thử ảo" type="submit" id="submit-btn"
                                                        class="btn btn-success mx-1">
                                                        <i class="fa-solid fa-camera"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ number_format($item->GiaBan, 0, ',', '.') }} ₫</h5>
                                            <p class="card-text">{{ $item->TenSP }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </section>
</div>

@endsection