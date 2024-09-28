<div class="container my-3">
    <div class="d-flex align-items-center">
        <div id="timkiem" class="input-group me-2">
            <input type="text" id="search" class="form-control" placeholder="Search for products">
            <button class="btn btn-outline-secondary">🔍</button>
        </div>
        <div id="ketquatim" class="list-group">
            <!-- Kết quả tìm kiếm sẽ hiển thị ở đây -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();

            // Kiểm tra xem từ khóa có độ dài hợp lệ
            if (query.length > 2) {
                $.ajax({
                    url: "{{ route('search') }}", // Gọi đến route search
                    type: 'GET',
                    data: { query: query }, // Gửi từ khóa tìm kiếm lên server
                    success: function(data) {
                        $('#ketquatim').empty(); // Xóa kết quả cũ

                        if (data.length > 0) {
                            $.each(data, function(index, product) {
                                $('#ketquatim').append(
                                    `<a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">${product.name}</h5>
                                            <small class="text-muted">Giá: $${product.price}</small>
                                        </div>
                                        <p class="mb-1">${product.description}</p>
                                    </a>`
                                );
                            });
                        } else {
                            $('#ketquatim').append('<p class="text-muted">Không tìm thấy sản phẩm</p>');
                        }
                    }
                });
            } else {
                $('#ketquatim').empty(); // Xóa kết quả nếu từ khóa quá ngắn
            }
        });
    });
</script>
