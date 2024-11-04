document.addEventListener("DOMContentLoaded", function () {
    var selectGongElement = document.getElementById('selectGong');
    var selectTrongElement = document.getElementById('selectTrong');
    var selectKhuyenMai = document.getElementById('selectKhuyenMai')
    if (selectGongElement) {
        // Nếu phần tử tồn tại, thực hiện các thao tác ở đây
        //console.log('Phần tử có id "selectGong" tồn tại.');

        // Các thao tác khác bạn muốn thực hiện
        document.getElementById('selectGong').addEventListener('change', function () {
            // Lấy option được chọn
            const selectedOption = this.options[this.selectedIndex];

            // Lấy các giá trị từ thuộc tính data-* trong option
            const mauGong = selectedOption.getAttribute('data-mau');
            const chieuDaiGong = selectedOption.getAttribute('data-dai');
            const chieuRongGong = selectedOption.getAttribute('data-rong');

            // Cập nhật giá trị cho các input
            document.getElementById('inputMauGong').value = mauGong;
            document.getElementById('inputChieuDai').value = chieuDaiGong;
            document.getElementById('inputChieuRong').value = chieuRongGong;

        });
    }
    if (selectTrongElement) {
        document.getElementById('selectTrong').addEventListener('change', function () {
            // Lấy option được chọn
            const selectedOption = this.options[this.selectedIndex];

            // Lấy các giá trị từ thuộc tính data-* trong option
            const mauTrong = selectedOption.getAttribute('data-mau');
            const doCaoTrong = selectedOption.getAttribute('data-cao');
            const doRongTrong = selectedOption.getAttribute('data-rong');

            // Cập nhật giá trị cho các input
            document.getElementById('inputMauTrong').value = mauTrong;
            document.getElementById('inputDoCao').value = doCaoTrong;
            document.getElementById('inputDoRong').value = doRongTrong;

        });
    }
    if (selectKhuyenMai) {
        document.getElementById('selectKhuyenMai').addEventListener('change', function () {
            // Lấy option được chọn
            const selectedOption = this.options[this.selectedIndex];

            // Lấy các giá trị từ thuộc tính data-* trong option
            const tyLeGiam = selectedOption.getAttribute('data-tylegiam');
            const soDienToiThieu = selectedOption.getAttribute('data-sdtt');
            const soTienToiThieu = selectedOption.getAttribute('data-sttt');

            // Cập nhật giá trị cho các input
            document.getElementById('inputTyLeGiam').value = tyLeGiam;
            document.getElementById('inputSoDiemToiThieu').value = soDienToiThieu;
            document.getElementById('inputSoTienToiThieu').value = soTienToiThieu;

        });
    }
});

function showLoginForm() {
    document.getElementById('loginOverlay').style.display = 'block';
}

function closeLoginForm() {
    document.getElementById('loginOverlay').style.display = 'none';
}

function showRegisterForm() {
    document.getElementById('registerOverlay').style.display = 'block';
    document.getElementById('loginOverlay').style.display = 'none';
}

function closeRegisterForm() {
    document.getElementById('registerOverlay').style.display = 'none';
    document.getElementById('loginOverlay').style.display = 'block';
}

function updateHiddenQuantity(productId) {
    var quantityInput = document.getElementById('quantity' + productId);
    var hiddenQuantityInput = document.getElementById('hiddenQuantity' + productId);
    
    hiddenQuantityInput.value = quantityInput.value;
}

setTimeout(function () {
    document.querySelectorAll('.alert').forEach(function (alert) {
        alert.style.display = 'none';
    });
}, 1000);

function confirmDelete() {
    return confirm('Bạn có chắc chắn muốn xoá dữ liệu này không?');
}

function confirmRestore() {
    return confirm('Bạn có chắc chắn muốn phục hồi dữ liệu đã xoá không?');
}

function detailsProduct() {
    const selectedOption = this.options[this.selectedIndex];

    // Lấy các giá trị từ thuộc tính data-* trong option
    const tyLeGiam = selectedOption.getAttribute('data-tylegiam');
    const soDienToiThieu = selectedOption.getAttribute('data-sdtt');
    const soTienToiThieu = selectedOption.getAttribute('data-sttt');

    // Cập nhật giá trị cho các input
    document.getElementById('inputTyLeGiam').value = tyLeGiam;
    document.getElementById('inputSoDiemToiThieu').value = soDienToiThieu;
    document.getElementById('inputSoTienToiThieu').value = soTienToiThieu;
}

// $(document).on('click', '.product-img', function () {
//     // Lấy ID sản phẩm từ thuộc tính data-id
//     var productId = $(this).data('id');
//     //alert(productId);
//     // Gửi yêu cầu AJAX đến server để lấy thông tin sản phẩm
//     $.ajax({
//         url: '/sanpham/' + productId, // Đường dẫn API trong Laravel
//         method: 'GET',
//         success: function (response) {
//             // Hiển thị thông tin sản phẩm trong trang
//             $('#chitietsanpham').empty().html(`
//                 <img src="${response.AnhSP}" class="card-img-top" alt="Deal product">
//                 <div class="card-body">
//                     <h5 class="card-title">Chi tiết sản phẩm</h5>
//                     <p>Loại SP: <strong>${response.LoaiSP}</strong></p>
//                     <p>Tên SP: <strong>${response.TenSP}</strong></p>
//                     <p>Giá bán: <strong>${response.GiaBan}</strong></p>
//                     <p>Trạng thái: ${response.TrangThaiSP == 1 ? '<span class="badge bg-success">Còn hàng</span>' : '<span class="badge bg-danger">Hết hàng</span>'}</p>
//                     <p>Đã bán: <span>5</span></p>
//                 </div>
//             `);
//         },
//         error: function () {
//             alert('Không thể lấy thông tin sản phẩm');
//         }
//     });
// });

function updateFavorite(MaSP) {
    let form = $('#favoriteForm' + MaSP);

    $.ajax({
        url: "/favorites/check",
        method: 'POST',
        data: {
            _token: form.find('input[name="_token"]').val(),  // Truyền CSRF token
            MaSP: MaSP,
        },

        success: function (response) {
            if (response.isInFavorite) {

                // Sản phẩm đã có trong giỏ hàng, hiển thị thông báo hỏi người dùng có muốn xóa không
                Swal.fire({
                    title: 'Sản phẩm đã có trong danh sách yêu thích. Bạn có muốn xóa sản phẩm này?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa sản phẩm',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu người dùng đồng ý xóa sản phẩm khỏi giỏ hàng
                        if (document.getElementById('favorite-products-container')) {
                            removeFromFavorite(MaSP);
                            location.reload();
                        } else {
                            // For homepage, just update the wishlist count
                            removeFromFavorite(MaSP);
                        }

                    } else {
                        console.log("Người dùng đã hủy thao tác.");
                    }
                });
            } else {
                Swal.fire({
                    title: 'Bạn có muốn thêm sản phẩm này vào danh sách yêu thích không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Thêm sản phẩm',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu sản phẩm chưa có trong giỏ, thêm sản phẩm vào giỏ hàng

                        if (document.getElementById('favorite-products-container')) {
                            addToFavorite(MaSP);
                            location.reload();
                        } else {
                            // For homepage, just update the wishlist count
                            addToFavorite(MaSP);
                        }
                    } else {
                        console.log("Người dùng đã hủy thao tác.");
                    }
                });

            }
        }
    });
}

function removeFromFavorite(MaSP) {
    let form = $('#favoriteForm' + MaSP);
    let url = form.attr('action').replace('add', 'remove');  // Cập nhật URL để xóa sản phẩm
    let method = 'DELETE';

    $.ajax({
        url: url,
        method: method,
        data: {
            _token: form.find('input[name="_token"]').val(),
            MaSP: MaSP
        },
        success: function (response) {
            if (response.success) {
                // Cập nhật giao diện sau khi xóa sản phẩm thành công
                showMessageCart('Sản phẩm đã được xóa khỏi danh sách yêu thích.');
                if (method === 'DELETE') {
                    // Chuyển từ xóa yêu thích sang thêm yêu thích
                    form.find('button').html('<i class="fa-regular fa-heart"></i>');
                    form.attr('action', response.addUrl);  // Cập nhật URL để thêm yêu thích
                    form.find('input[name="_method"]').remove();  // Xóa phương thức DELETE
                } else {
                    // Chuyển từ thêm yêu thích sang xóa yêu thích
                    form.find('button').html('<i class="fa-solid fa-heart"></i>');
                    form.attr('action', response.removeUrl);  // Cập nhật URL để xóa yêu thích
                    form.prepend('<input type="hidden" name="_method" value="DELETE">');  // Thêm phương thức DELETE
                }
                // Cập nhật số lượng sản phẩm yêu thích
                if (response.soLuongSanPham !== undefined) {
                    $('#wishlist-count').text(response.soLuongSanPham);
                }
            }
        },
        error: function (xhr) {
            alert('Có lỗi xảy ra, vui lòng thử lại.');
            console.error(xhr.responseText);
        }
    });
}

function addToFavorite(MaSP) {
    let form = $('#favoriteForm' + MaSP);
    let url = form.attr('action').replace('remove', 'add');
    let method = 'POST';

    $.ajax({
        url: url,
        method: method,
        data: {
            _token: form.find('input[name="_token"]').val(),
            MaSP: MaSP
        },
        success: function (response) {
            if (response.success) {
                // Hiển thị thông báo thành công
                showMessageCart(response.message);
                if (method === 'DELETE') {
                    // Chuyển từ xóa yêu thích sang thêm yêu thích
                    form.find('button').html('<i class="fa-regular fa-heart"></i>');
                    form.attr('action', response.addUrl);  // Cập nhật URL để thêm yêu thích
                    form.find('input[name="_method"]').remove();  // Xóa phương thức DELETE
                } else {
                    // Chuyển từ thêm yêu thích sang xóa yêu thích
                    form.find('button').html('<i class="fa-solid fa-heart"></i>');
                    form.attr('action', response.removeUrl);  // Cập nhật URL để xóa yêu thích
                    form.prepend('<input type="hidden" name="_method" value="DELETE">');  // Thêm phương thức DELETE
                }
                // Cập nhật số lượng sản phẩm yêu thích
                if (response.soLuongSanPham !== undefined) {
                    $('#wishlist-count').text(response.soLuongSanPham);
                }
            }
        },
        error: function (xhr) {
            alert('Có lỗi xảy ra, vui lòng thử lại.');
            console.error(xhr.responseText);
        }
    });
}

function showMessage(message) {
    // Tạo thông báo trong giao diện người dùng
    let alertBox = $('<div class="alert alert-success"></div>').text(message);
    $('body').append(alertBox);

    // Tự động ẩn sau 3 giây
    setTimeout(function () {
        alertBox.fadeOut(500, function () {
            $(this).remove();
        });
    }, 3000);
}

function updateCart(MaSP) {
    let form = $('#cartForm' + MaSP);
    let SoLuongSP = form.find('input[name="SoLuongSP"]').val();
    //alert(SoLuongSP);
    // alert('url: ' + url + ', method: ' + method );
    $.ajax({
        url: "/cart/check",
        method: 'POST',
        data: {
            _token: form.find('input[name="_token"]').val(),  // Truyền CSRF token
            MaSP: MaSP,
            SoLuongSP: SoLuongSP
        },

        success: function (response) {
            if (response.isInCart) {
                // Sản phẩm đã có trong giỏ hàng, hiển thị thông báo hỏi người dùng có muốn xóa không
                Swal.fire({
                    title: 'Sản phẩm đã có trong giỏ hàng. Bạn có muốn xóa sản phẩm này?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa sản phẩm',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (document.getElementById('cart-products-container')) {
                            removeFromCart(MaSP);
                            location.reload();
                        } else {
                            // For homepage, just update the wishlist count
                            removeFromCart(MaSP);
                        }
                    } else {
                        console.log("Người dùng đã hủy thao tác.");
                    }
                });
            } else {
                Swal.fire({
                    title: 'Bạn có muốn thêm sản phẩm này vào giỏ hàng không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Thêm sản phẩm',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu sản phẩm chưa có trong giỏ, thêm sản phẩm vào giỏ hàng
                        if (document.getElementById('favorite-products-container')) {
                            addToCart(MaSP, SoLuongSP);
                            removeFromFavorite(MaSP);
                            location.reload();
                        } else {
                            // For homepage, just update the wishlist count
                            addToCart(MaSP, SoLuongSP);
                        }
                        
                    } else {
                        console.log("Người dùng đã hủy thao tác.");
                    }
                });

            }
        },
        error: function (xhr, status, error) {
            if (xhr.status === 500) {
                alert('Lỗi server (500 Internal Server Error): Có vấn đề từ phía server.');
            } else {
                alert('Lỗi khác: ' + xhr.status + ' - ' + xhr.statusText);
            }
            console.error('Chi tiết lỗi:', xhr.responseText);
        }
    });
}

function showMessageCart(message) {
    // Tạo thông báo trong giao diện người dùng
    let alertBox = $('<div class="alert alert-success"></div>').text(message);
    $('body').append(alertBox);

    // Tự động ẩn sau 3 giây
    setTimeout(function () {
        alertBox.fadeOut(500, function () {
            $(this).remove();
        });
    }, 3000);
}

function removeFromCart(MaSP) {
    let form = $('#cartForm' + MaSP);
    let url = form.attr('action').replace('add', 'remove');  // Cập nhật URL để xóa sản phẩm
    let method = 'DELETE';

    $.ajax({
        url: url,
        method: method,
        data: {
            _token: form.find('input[name="_token"]').val(),
            MaSP: MaSP
        },
        success: function (response) {
            //alert(response.message);
            if (response.success) {
                // Cập nhật giao diện sau khi xóa sản phẩm thành công
                showMessageCart('Sản phẩm đã được xóa khỏi giỏ hàng.');
                if (method === 'DELETE') {
                    // Chuyển từ xóa yêu thích sang thêm yêu thích
                    form.find('button').html('<i class="fa-solid fa-cart-shopping"></i>');
                    form.append('<input type="number" name="SoLuongSP" id="SoLuongSP" class="form-control" hidden value="1">');
                    form.attr('action', response.addUrl);  // Cập nhật URL để thêm yêu thích
                    form.find('input[name="_method"]').remove();  // Xóa phương thức DELETE
                } else {
                    // Chuyển từ thêm yêu thích sang xóa yêu thích
                    form.find('button').html('<i class="fa-solid fa-cart-shopping"></i>');
                    // Xóa toàn bộ input cũ trước khi thêm mới (nếu cần)
                    form.find('input').not('[name="_method"], [name="_token"]').remove();
                    form.attr('action', response.removeUrl);  // Cập nhật URL để xóa yêu thích
                    form.prepend('<input type="hidden" name="_method" value="DELETE">');  // Thêm phương thức DELETE
                }
                // Cập nhật số lượng sản phẩm yêu thích
                if (response.sanPhamTrongGH !== undefined) {
                    $('#cart-count').text(response.sanPhamTrongGH);
                }
            }
        },
        error: function (xhr) {
            alert('Có lỗi xảy ra, vui lòng thử lại.');
            console.error(xhr.responseText);
        }
    });
}

function updateOrder(DonHang, MaSP) {
    let form = $('#orderForm' + MaSP);

    $.ajax({
        url: "/donhang/check",
        method: 'POST',
        data: {
            _token: form.find('input[name="_token"]').val(),  // Truyền CSRF token
            MaSP: MaSP,
        },

        success: function (response) {
            if (response.isInOrder) {
                // Sản phẩm đã có trong giỏ hàng, hiển thị thông báo hỏi người dùng có muốn xóa không
                Swal.fire({
                    title: 'Sản phẩm đang ở trong đơn hàng. Bạn có muốn huỷ đặt sản phẩm này?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Huỷ đặt sản phẩm',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu người dùng đồng ý xóa sản phẩm khỏi giỏ hàng
                        if (document.getElementById('order-products-container')) {
                            removeFromOrder(MaSP, DonHang);
                            location.reload();
                        } else {
                            // For homepage, just update the wishlist count
                            removeFromOrder(MaSP, DonHang);
                        }
                        
                    } else {
                        console.log("Người dùng đã hủy thao tác.");
                    }
                });
            }
        },
        error: function (xhr, status, error) {
            if (xhr.status === 500) {
                alert('Lỗi server (500 Internal Server Error): Có vấn đề từ phía server.');
            } else {
                alert('Lỗi khác: ' + xhr.status + ' - ' + xhr.statusText);
            }
            console.error('Chi tiết lỗi:', xhr.responseText);
        }
    });
}

function removeFromOrder(MaSP, DonHang) {
    let form = $('#orderForm' + MaSP);
    let url = form.attr('action');  // Cập nhật URL để xóa sản phẩm
    let method =  form.find('input[name="_method"]').val() === 'DELETE' ? 'DELETE' : 'POST';

    $.ajax({
        url: url,
        method: method,
        data: {
            _token: form.find('input[name="_token"]').val(),
            donHang: DonHang,
            sanPham: MaSP,
        },
        success: function (response) {
            if (response.success) {
                // Cập nhật giao diện sau khi xóa sản phẩm thành công
                showMessageCart('Sản phẩm đã được huỷ khỏi đơn hàng.');
            }
        },
        error: function (xhr) {
            if (xhr.status === 500) {
                alert('Lỗi server (500 Internal Server Error): Có vấn đề từ phía server.');
            } else {
                alert('Lỗi khác: ' + xhr.status + ' - ' + xhr.statusText);
            }
            console.error('Chi tiết lỗi:', xhr.responseText);
        }
    });
}

function addToCart(MaSP, SoLuongSP) {
    let form = $('#cartForm' + MaSP);
    let url = form.attr('action').replace('remove', 'add');
    let method = 'POST';
    
    $.ajax({
        url: url,
        method: method,
        data: {
            _token: form.find('input[name="_token"]').val(),
            SoLuongSP: SoLuongSP,
            MaSP: MaSP
        },
        success: function (response) {
            if (response.success) {
                // Hiển thị thông báo thành công
                showMessageCart(response.message);
                if (method === 'DELETE') {
                    // Chuyển từ xóa yêu thích sang thêm yêu thích
                    form.find('button').html('<i class="fa-solid fa-cart-shopping"></i>');
                    form.append('<input type="number" name="SoLuongSP" id="SoLuongSP" class="form-control" hidden value="1">');
                    form.attr('action', response.addUrl);  // Cập nhật URL để thêm yêu thích
                    form.find('input[name="_method"]').remove();  // Xóa phương thức DELETE
                } else {
                    // Chuyển từ thêm yêu thích sang xóa yêu thích
                    form.find('button').html('<i class="fa-solid fa-cart-shopping"></i>');
                    // Xóa toàn bộ input cũ trước khi thêm mới (nếu cần)
                    form.find('input').not('[name="_method"], [name="_token"]').remove();
                    form.attr('action', response.removeUrl);  // Cập nhật URL để xóa yêu thích
                    form.prepend('<input type="hidden" name="_method" value="DELETE">');  // Thêm phương thức DELETE
                }
                // Cập nhật số lượng sản phẩm yêu thích
                if (response.sanPhamTrongGH !== undefined) {
                    $('#cart-count').text(response.sanPhamTrongGH);
                }
            }
        },
        error: function (xhr) {
            if (xhr.status === 500) {
                alert('Lỗi server (500 Internal Server Error): Có vấn đề từ phía server.');
            } else {
                alert('Lỗi khác: ' + xhr.status + ' - ' + xhr.statusText);
            }
            console.error('Chi tiết lỗi:', xhr.responseText);
        }
    });
}

document.getElementById('bulk-payment-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Ngăn gửi form tự động

    // Lấy danh sách sản phẩm đã chọn
    let selectedProducts = [];
    alert(selectedProducts);
    document.querySelectorAll('.select-product-checkbox:checked').forEach(function (checkbox) {
        let productId = checkbox.value; // Mã sản phẩm
        let quantityInput = document.querySelector(`.product-quantity[data-product-id="${productId}"]`);
        let quantity = quantityInput ? quantityInput.value : 1; // Lấy số lượng hoặc mặc định là 1

        // Đưa cả mã sản phẩm và số lượng vào mảng
        selectedProducts.push({
            id: productId,
            quantity: quantity
        });
    });

    // Gửi dữ liệu nếu có sản phẩm được chọn
    if (selectedProducts.length > 0) {
        document.getElementById('selected-products').value = JSON.stringify(selectedProducts);
        // Xác định rõ ràng phương thức POST
        const form = this;

        //alert(form.method.toUpperCase());
        if (form.method.toUpperCase() === 'POST') {
            // In ra phương thức và action của form để kiểm tra
            
            form.submit(); // Gửi form
        } else {
            console.error("Form không được cấu hình đúng với phương thức POST.");
        }
    } else {
        Swal.fire({
            title: 'Vui lòng chọn ít nhất một sản phẩm để thanh toán.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    }
});


$(document).ready(function () {
    // Lắng nghe sự kiện thay đổi số lượng
    $('.product-quantity').on('change', function () {
        var productId = $(this).data('product-id'); // Lấy mã sản phẩm
        var newQuantity = $(this).val(); // Lấy số lượng mới
        var token = $('input[name="_token"]').val(); // CSRF token
        // Gửi yêu cầu AJAX đến server
        $.ajax({
            url: '/cart/update', // Đường dẫn đến route xử lý thay đổi số lượng
            method: 'POST',
            data: {
                _token: token,
                MaSP: productId,
                quantity: newQuantity
            },
            success: function (response) {
                // Cập nhật các phần tử trên giao diện
                $('#total-price').text(response.totalPriceFormatted + ' ₫'); // Cập nhật tổng tiền
                $('#product-' + productId + '-total').text(response.productTotalFormatted + ' ₫'); // Cập nhật thành tiền của sản phẩm
            },
            error: function (xhr) {
                console.error(xhr.responseText); // Log lỗi nếu có
            }
        });
    });
});

setTimeout(function () {
    $(".loader-div").hide();
}, 5000);
