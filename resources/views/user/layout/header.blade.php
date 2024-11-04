<header class="">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-between w-50">
            <div>
                <img src="{{ asset('img/shopping.png') }}" class="" alt="Logo">
            </div>

            <div class="flex-grow-1 my-3 center-search" style="margin-left: 50px">
                <div class="d-flex justify-content-center align-items-center">
                    <div id="timkiem" class="input-group me-2" style="max-width: 600px; width: 100%;">
                        <form action="{{route('sanpham.search')}}" method="GET" class="w-100">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search for products"
                                    autocomplete="off" required>
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Phần tử này để hiển thị kết quả tìm kiếm -->
                    <div id="ketquatim" class="position-absolute bg-white w-100 shadow mt-2"
                        style="z-index: 1000; display: none;">
                        <!-- Kết quả tìm kiếm sẽ hiển thị ở đây -->
                    </div>


                </div>
            </div>
        </div>

        <!-- Search and Icons -->


        <!-- Authentication Links -->
        <div class="d-flex">
            <span class="me-2">
                <form method="POST" class="d-inline" action="{{ route('change.language') }}">
                    @csrf
                    <select name="language" id="languageSelect" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                        <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}><i class="bi bi-flag"></i>English</option>
                        <option value="vi" {{ session('locale') == 'vi' ? 'selected' : '' }}><i class="bi bi-flag-fill"></i>Tiếng Việt</option>
                        <option value="ja" {{ session('locale') == 'ja' ? 'selected' : '' }}><i class="bi bi-flag-fill"></i>Japanese</option>
                        <option value="zh-TW" {{ session('locale') == 'zh-TW' ? 'selected' : '' }}><i class="bi bi-flag-fill"></i>Chinese</option>
                        <option value="ko" {{ session('locale') == 'ko' ? 'selected' : '' }}><i class="bi bi-flag-fill"></i>Korean</option>
                        <option value="th" {{ session('locale') == 'th' ? 'selected' : '' }}><i class="bi bi-flag-fill"></i>Thai</option>
                    </select>
                </form>
            </span>
            <span class="me-2">
                @if (session()->has('MaKH'))
                    <a href="{{route('favorite.index')}}"
                        class="text-decoration-none text-dark btn btn-outline-secondary border-0">
                        <i class="bi bi-heart"></i>
                        <span class="badge bg-danger"
                            id="wishlist-count">{{ count($soLuongSanPham) > 0 ? count($soLuongSanPham) : 0 }}
                        </span>
                    </a>
                @else
                    <a href="#" onclick="showLoginForm()" class="text-decoration-none text-dark btn btn-outline-secondary border-0">
                        <i class="bi bi-heart"></i>
                        <span class="badge bg-danger" id="wishlist-count">0
                        </span>
                    </a>
                @endif

            </span>
            <span>
                @if (session()->has('MaKH'))
                    <a href="{{route('cart.index')}}"
                        class="text-decoration-none text-dark btn btn-outline-secondary border-0">
                        <i class="bi bi-cart"></i>
                        <span class="badge bg-danger"
                            id="cart-count">{{ count($sanPhamTrongGH) > 0 ? count($sanPhamTrongGH) : 0 }}
                        </span>
                    </a>
                @else
                    <a href="#" onclick="showLoginForm()"
                        class="text-decoration-none text-dark btn btn-outline-secondary border-0">
                        <i class="bi bi-cart"></i>
                        <span class="badge bg-danger" id="cart-count">0
                        </span>
                    </a>

                @endif
            </span>
            <span>
                
            </span>
            <div class="d-flex align-items-center">
                @if (session()->has('MaKH'))
                    <div class="dropdown">
                        <a class="btn dropdown-toggle bg-light-subtle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="me-2 text-dark">{{ session('TenKH') }}</span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('hoso.profile')}}" class="btn btn-outline-light border-0 text-dark"
                                    style="outline: none; box-shadow: none; width: 100%; text-align: left">{{ translateText('Hồ sơ')}}</a>
                            </li>
                            <li>
                                <a href="{{route('donhang.index')}}" class="btn btn-outline-light border-0 text-dark"
                                    style="outline: none; box-shadow: none; width: 100%; text-align: left">{{ translateText('Đơn hàng')}}</a>
                            </li>
                            <hr>
                            <li>
                                <form class="dropdown-item d-flex align-items-center" action="{{ route('logout') }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>{{ translateText('Đăng xuất')}}</span>
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>
                @else
                    <a href="#" onclick="showLoginForm()" class="me-2 text-dark btn btn-outline-light border-0">{{ translateText('Login')}} | {{ translateText('Register')}}</a>
                @endif
            </div>
        </div>

    </div>
</header>
<nav class="bg-secondary position-sticky" style="top: 0; overflow: hidden; z-index: 100;">
    <div class="container">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{route('sanpham.index')}}">{{ translateText('Trang chủ')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">{{ translateText('Giới thiệu')}}</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link text-white" href="">Profile</a>
            </li> -->
        </ul>
    </div>
</nav>