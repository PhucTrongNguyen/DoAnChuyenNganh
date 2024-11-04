@if (count($soLuongSanPham) > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @foreach ($soLuongSanPham as $favoriteId)
            @php
                $product = \App\Models\SanPham::where('MaSP', $favoriteId)->first();
            @endphp

            @if ($product)
                <div class="col">
                    <div class="card" style="height: 400px;">
                        <div class="image-container" style="height: 250px; overflow: hidden;">
                            <img src="{{ asset($product->AnhSP) ?? 'https://via.placeholder.com/400' }}" class="card-img-top"
                                alt="{{ $product->TenSP }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body" style="position: absolute; bottom: 0px; width: 100%;">
                            <div>
                                <h5 class="card-title">{{ $product->TenSP }}</h5>
                                <p class="card-text">{{ number_format($product->GiaBan, 0, ',', '.') }} ₫</p>
                            </div>
                            <br>
                            <div style="display: flex; gap: 10px;">
                                <form id="cartForm{{ $product->MaSP }}" 
                                    action="{{ in_array($product->MaSP, $sanPhamTrongGH) ? route('cart.remove', $product->MaSP) : route('cart.add', $product->MaSP) }}"
                                    method="POST" onsubmit="event.preventDefault(); updateCart('{{ $product->MaSP }}');">
                                    @csrf
                                    @if (in_array($product->MaSP, $sanPhamTrongGH))
                                        @method('DELETE')
                                        <button title="Xoá khỏi giỏ hàng" type="submit" class="btn btn-primary mx-1" aria-label="Remove from cartlist">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    @else
                                        <input type="number" name="SoLuongSP" id="SoLuongSP" class="form-control" value="1" min="1"
                                            hidden>
                                        <button title="Thêm vào giỏ hàng" type="submit" class="btn btn-primary mx-1" aria-label="Add from cartlist">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    @endif
                                </form>
                                <form id="favoriteForm{{ $product->MaSP }}" action="{{route('favorite.remove', $product->MaSP)}}"
                                    method="POST" style="display: inline;"
                                    onsubmit="event.preventDefault(); updateFavorite('{{ $product->MaSP }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Xoá khỏi wishlist" class="btn btn-warning mx-1" type="submit" aria-label="Remove from wishlist">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                </form>
                                <form id="image-form" method="post" enctype="multipart/form-data"
                                    action="{{ route('run.python.script') }}">
                                    @csrf
                                    <input type="hidden" name="image_path" value="{{$product->AnhSP}}">
                                    <button type="submit" id="submit-btn" class="btn btn-success mx-1">
                                        <i class="fa-solid fa-camera"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@else
    <div class="alert alert-warning" role="alert">
        You have no favorite products yet!
    </div>
@endif