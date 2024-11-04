<form action="{{route('sanpham.details', $item->MaSP)}}" method="GET">
    <button title="Chi tiết sản phẩm" type="submit" class="btn btn-light mx-1">
        <i class="fa-solid fa-circle-info"></i>
    </button>
</form>
@if (session()->has('MaKH'))
    <form id="favoriteForm{{ $item->MaSP }}"
        action="{{ in_array($item->MaSP, $soLuongSanPham) ? route('favorite.remove', $item->MaSP) : route('favorite.add', $item->MaSP) }}"
        method="POST" style="display: inline;" onsubmit="event.preventDefault(); updateFavorite('{{ $item->MaSP }}');">
        @csrf
        @if (in_array($item->MaSP, $soLuongSanPham))
            @method('DELETE')
            <button title="Xoá khỏi wishlist" class="btn btn-warning mx-1" type="submit" aria-label="Remove from wishlist">
                <i class="fa-solid fa-heart"></i>
            </button>
        @else
            <button title="Thêm vào wishlist" class="btn btn-warning mx-1" type="submit" aria-label="Add to wishlist">
                <i class="fa-regular fa-heart"></i>
            </button>
        @endif
    </form>
@else
    <button title="Thêm vào wishlist" class="btn btn-warning mx-1" type="submit" aria-label="Add to wishlist"
        onclick="showLoginForm()">
        <i class="fa-regular fa-heart"></i>
    </button>
@endif
@if (session()->has('MaKH'))
    <form id="cartForm{{ $item->MaSP }}"
        action="{{ in_array($item->MaSP, $sanPhamTrongGH) ? route('cart.remove', $item->MaSP) : route('cart.add', $item->MaSP) }}"
        method="POST" onsubmit="event.preventDefault(); updateCart('{{ $item->MaSP }}');">
        @csrf
        <!-- Nếu đã đăng nhập, kiểm tra xem sản phẩm có trong giỏ hàng hay không -->
        @if($item->TrangThaiSP != 0)
            @if (in_array($item->MaSP, $sanPhamTrongGH))
                @method('DELETE')
                <button title="Xoá vào giỏ hàng" type="submit" class="btn btn-primary" aria-label="Remove from cartlist">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            @else
                <!-- Trường ẩn để lưu số lượng sản phẩm -->
                <input type="number" name="SoLuongSP" id="hiddenQuantity{{ $item->MaSP }}" class="form-control" value="1" min="1"
                    hidden>
                <button title="Thêm khỏi giỏ hàng" type="submit" class="btn btn-primary" aria-label="Add from cartlist">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            @endif
        @endif

    </form>
@else
    <!-- Nếu chưa đăng nhập, chỉ hiển thị nút thêm vào giỏ hàng nhưng không thực hiện hành động -->
    <button title="Thêm vào giỏ hàng" type="submit" class="btn btn-primary mx-1" aria-label="Add to cartlist"
        onclick="showLoginForm()">
        <i class="fa-solid fa-cart-shopping"></i>
    </button>
@endif
<form id="image-form" method="post" enctype="multipart/form-data" action="{{ route('run.python.script') }}">
    @csrf
    <input type="hidden" name="image_path" value="{{$item->AnhSP}}">
    <button type="submit" id="submit-btn" class="btn btn-success mx-1">
        <i class="fa-solid fa-camera"></i>
    </button>
</form>