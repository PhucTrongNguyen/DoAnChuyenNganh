<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/93c0950cc1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Import SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js', 'resources/js/search.js']) -->
</head>

<body>
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
    <div id="loginOverlay" class="overlay" style="display: none;">
        @include('auth.login')
    </div>
    <div id="registerOverlay" class="overlay" style="display: none;">
        @include('auth.register')
    </div>
    <div class="loader-div">
        <img class="loader-img" src="{{asset('img/loading.gif')}}" alt="" style="height: 10px;width: auto;">
    </div>
    @include('user.layout.header')

    @yield('content')

    @include('user.layout.footer')
    <script src="{{url('js/main.js')}}"></script>
    <script>
        $(document).ready(function () {
            var currentTab = 'feat'; // Mặc định là tab "Featured"
            // Lắng nghe sự kiện click trên các tab
            $(document).on('click', '.nav-link', function () {
                // Xóa trạng thái active khỏi tất cả các tab
                $('.nav-link').removeClass('active');
                // Đặt trạng thái active cho tab hiện tại
                $(this).addClass('active');

                // Lấy ID của tab được chọn
                var targetTab = $(this).data('bs-target').substring(1);
                // Hiển thị tab tương ứng
                $('.tab-pane').removeClass('show active');
                $(targetTab).addClass('show active');

                // Cập nhật currentTab
                //currentTab = targetTab;

                // Khi nhấn vào tab, lấy sản phẩm cho trang đầu tiên của tab đó
                getData(1, targetTab);
            });

            // Lắng nghe sự kiện click trên các liên kết phân trang
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var currentTab = $('.nav-link.active').data('bs-target'); // Lấy tab hiện tại
                console.log('Current Tab:', currentTab, 'Page:', page);
                getData(page, currentTab); // Gọi lại getData với trang và tab hiện tại
            });

            // Hàm để tải dữ liệu
            function getData(page, tab) {
                var myurl = '?page=' + page + '&tab=' + tab.replace('#', ''); // Gửi tab qua URL
                console.log(myurl);
                $.ajax({
                    url: '?page=' + page + '&tab=' + tab.replace('#', ''), // Gửi tab qua URL
                    type: 'get',
                    dataType: 'html',
                })
                    .done(function (data) {
                        // Cập nhật danh sách sản phẩm
                        $('#product-list').empty().html(data);
                        // Cập nhật các liên kết phân trang
                        $('.pagination-links').html(data.links);
                        // Lưu trạng thái trang vào history
                        window.history.pushState({ page: page, tab: tab.replace('#', '') }, '', '?page=' + page + '&tab=' + tab.replace('#', ''));
                    })
                    .fail(function (jqXHR, ajaxOptions, throwError) {
                        console.error('Error loading data: ', throwError);
                        alert('No response from server');
                    });
            }

            // Xử lý trạng thái quay lại trang
            $(window).on('popstate', function (event) {
                if (event.originalEvent.state) {
                    var page = event.originalEvent.state.page;
                    var tab = event.originalEvent.state.tab;
                    getData(page, '#' + tab); // Gọi lại getData cho trang và tab
                }
            });
        });

        $(document).on('submit', '#image-form', function (e) {
            e.preventDefault(); //  Ngăn chặn form gửi thông thường

            // Lấy đường dẫn hình ảnh từ nút
            var imagePath = $(this).find('input[name="image_path"]').val();
            // Lấy giá trị CSRF token từ form
            var csrfToken = $(this).find('input[name="_token"]').val();
            $.ajax({
                url: $(this).attr('action'), // Lấy URL từ action của form
                type: 'POST',
                data: {
                    _token: csrfToken,
                    image_path: imagePath,
                }, // Lấy dữ liệu từ form
                beforeSend: function () {
                    // Hiển thị ảnh loading trước khi gửi AJAX
                    $(".loader-div").css('display', 'block');
                    // Vô hiệu hóa nút submit để ngăn người dùng nhấn nhiều lần
                    $('#submit-btn').prop('disabled', true);
                },
                success: function (response) {
                    // Xử lý thành công, hiển thị thông báo hoặc cập nhật giao diện
                    $(".loader-div").hide();
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    // Xử lý lỗi
                    console.log(error);
                    console.error(xhr.responseText);
                },
                complete: function () {
                    // Ẩn ảnh loading và kích hoạt lại nút submit sau khi AJAX hoàn tất
                    $('.loader-div').css('display', 'none');
                    $('#submit-btn').prop('disabled', false);
                }
            });
        });

        $(document).on('submit', '#image-form-detail', function (e) {
            e.preventDefault(); //  Ngăn chặn form gửi thông thường

            // Lấy đường dẫn hình ảnh từ nút
            var imagePath = $('input[name="image_path"]').val();
            // Lấy giá trị CSRF token từ form
            var csrfToken = $(this).find('input[name="_token"]').val();
            $.ajax({
                url: $(this).attr('action'), // Lấy URL từ action của form
                type: 'POST',
                data: {
                    _token: csrfToken,
                    image_path: imagePath,
                }, // Lấy dữ liệu từ form
                beforeSend: function () {
                    // Hiển thị ảnh loading trước khi gửi AJAX
                    $(".loader-div").css('display', 'block');
                    // Vô hiệu hóa nút submit để ngăn người dùng nhấn nhiều lần
                    $('#submit-btn').prop('disabled', true);
                },
                success: function (response) {
                    // Xử lý thành công, hiển thị thông báo hoặc cập nhật giao diện
                    $(".loader-div").hide();
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    // Xử lý lỗi
                    console.log(error);
                    console.error(xhr.responseText);
                },
                complete: function () {
                    // Ẩn ảnh loading và kích hoạt lại nút submit sau khi AJAX hoàn tất
                    $('.loader-div').css('display', 'none');
                    $('#submit-btn').prop('disabled', false);
                }
            });
        });
    </script>
    
    <script src="{{url('js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>

</html>