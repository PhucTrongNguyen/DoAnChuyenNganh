<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('css/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('css/quill.snow.css')}}" rel="stylesheet">
  <link href="{{url('css/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{url('css/remixicon.css')}}" rel="stylesheet">
  <link href="{{url('css/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{url('css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <!-- Hiển thị thông báo nếu có -->
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{url(path: 'img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{url('img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('TenQL') }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ session('TenQL') }}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form class="dropdown-item d-flex align-items-center" action="{{ route('logout') }}" method="POST"
                style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Đăng xuất</span>
                </button>
              </form>

              <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a> -->
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Bảng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('sanpham.index')}}">
              <i class="bi bi-circle"></i><span>Sản phẩm</span>
            </a>
          </li>
          <li>
            <a href="{{route('nhacungcap.index')}}">
              <i class="bi bi-circle"></i><span>Nhà cung cấp</span>
            </a>
          </li>
          <li>
            <a href="{{route('thuonghieu.index')}}">
              <i class="bi bi-circle"></i><span>Thương hiệu</span>
            </a>
          </li>
          <li>
            <a href="{{route('loaimatkinh.index')}}">
              <i class="bi bi-circle"></i><span>Loại mắt kính</span>
            </a>
          </li>
          <li>
            <a href="{{route('domatkinh.index')}}">
              <i class="bi bi-circle"></i><span>Độ mắt kính</span>
            </a>
          </li>
          <li>
            <a href="{{route('thongsogong.index')}}">
              <i class="bi bi-circle"></i><span>Thông số gòng</span>
            </a>
          </li>
          <li>
            <a href="{{route(name: 'thongsotrong.index')}}">
              <i class="bi bi-circle"></i><span>Thông số tròng</span>
            </a>
          </li>
          <li>
            <a href="{{route('diachi.index')}}">
              <i class="bi bi-circle"></i><span>Địa chỉ</span>
            </a>
          </li>
          <li>
            <a href="{{route('nguoiquanly.index')}}">
              <i class="bi bi-circle"></i><span>Người quản lý</span>
            </a>
          </li>
          <li>
            <a href="{{route('khachhang.index')}}">
              <i class="bi bi-circle"></i><span>Khách hàng</span>
            </a>
          </li>
          <li>
            <a href="{{route('giohang.index')}}">
              <i class="bi bi-circle"></i><span>Giỏ hàng</span>
            </a>
          </li>
          <li>
            <a href="{{route('danhsachyeuthich.index')}}">
              <i class="bi bi-circle"></i><span>Danh sách yêu thích</span>
            </a>
          </li>
          <li>
            <a href="{{route('banner.index')}}">
              <i class="bi bi-circle"></i><span>Banners</span>
            </a>
          </li>
          <li>
            <a href="{{route('danhgiakhachhang.index')}}">
              <i class="bi bi-circle"></i><span>Đánh giá khách hàng</span>
            </a>
          </li>
      </li>
    </ul>
    </li>
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section dashboard">
      @yield('content')
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <div class="loader-div">
    <img class="loader-img" src="{{asset('img/30.gif')}}" alt="" style="height: 10px;width: auto;">
  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{url('js/apexcharts.min.js')}}"></script>
  <script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('js/chart.umd.js')}}"></script>
  <script src="{{url('js/echarts.min.js')}}"></script>
  <script src="{{url('js/quill.js')}}"></script>
  <script src="{{url('js/simple-datatables.js')}}"></script>
  <script src="{{url('js/tinymce.min.js')}}"></script>
  <script src="{{url('js/validate.js')}}"></script>
  <script src="{{url('js/scripts.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('js/main.js')}}"></script>

</body>

</html>