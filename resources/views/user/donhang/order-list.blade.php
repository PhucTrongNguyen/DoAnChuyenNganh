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
@if (!empty($dh) && count($dh) > 0)
    @php    $index = 1; @endphp
    @foreach ($dh as $donHang)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="8">
                        @if ($donHang->TrangThaiDonHang != "Đã hủy")
                            <input type="checkbox" name="donHangDuocChon[]" value="{{ $donHang->MaDH }}"
                                class="select-product-checkbox">
                        @else
                            <span></span>
                        @endif
                        <strong>{{ translateText('Mã đơn hàng')}}:</strong> {{ $donHang->MaDH }}
                        <strong>{{ translateText('Trạng thái')}}:</strong> {{ $donHang->TrangThaiDonHang }}
                    </th>
                </tr>
                <tr>
                    <th>{{ translateText('STT')}}</th>
                    <th>{{ translateText('Ảnh')}} SP</th>
                    <th>{{ translateText('Tên')}} SP</th>
                    <th>{{ translateText('Số lượng')}}</th>
                    <th>{{ translateText('Đơn giá')}}</th>
                    <th>{{ translateText('Thành tiền')}}</th>
                    <th>{{ translateText('Ngày đặt')}}</th>
                    <th>{{ translateText('Chức năng')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donHang->sanPhams as $sp)
                    @php
                        $product = \App\Models\SanPham::where('MaSP', $sp->MaSP)->first();
                        if ($donHang->TrangThaiDonHang != "Đã hủy") {
                            $total += $sp->pivot->DonGia * $sp->pivot->SoLuongSP;
                        }
                    @endphp
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>
                            <img src="{{ asset($sp->AnhSP) }}" width="50" height="50" alt="{{ $sp->TenSP }}">
                        </td>
                        <td>{{ translateText($sp->TenSP)}}</td>
                        <td>{{ $sp->pivot->SoLuongSP }}</td> <!-- Lấy từ bảng trung gian -->
                        <td>
                            {{ CurrencyHelper::formatCurrency($sp->pivot->DonGia, $selectedCurrency, $selectedLocale) }}
                            
                        </td> <!-- Đơn giá từ bảng trung gian -->
                        <td>
                        {{ CurrencyHelper::formatCurrency($sp->pivot->ThanhTien, $selectedCurrency, $selectedLocale) }}
                        
                        </td>
                        <td>
                            @if ($donHang->NgayDatDH instanceof \Carbon\Carbon)
                                {{ $donHang->NgayDatDH->format('d/m/Y') }}
                            @else
                                {{ $donHang->NgayDatDH }} <!-- In ra giá trị để kiểm tra -->
                            @endif
                        </td> <!-- Ngày đặt hàng -->
                        <td>
                            @if ($donHang->TrangThaiDonHang != "Đã hủy")
                                <form id="orderForm{{ $sp->MaSP }}"
                                    action="{{ route('donhang.destroy', ['donHang' => $donHang->MaDH, 'sanPham' => $sp->MaSP]) }}"
                                    method="POST"
                                    onsubmit="event.preventDefault(); updateOrder('{{$donHang->MaDH}}', '{{ $sp->MaSP }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ translateText('Huỷ đặt sản phẩm')}}</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            <h4>{{ translateText('Tổng tiền')}}: <span id="total-price">
            {{ CurrencyHelper::formatCurrency($total, $selectedCurrency, $selectedLocale) }}
                </span>
            </h4>
        </div>
    @endforeach
    <!-- Tổng tiền -->
    <div class="d-flex justify-content-end">
        <a href="{{ route('donhang.cancel')}}" id="cancel-all-orders" style="margin-right: 30px" class="btn btn-success">
        {{ translateText('Huỷ tất cả đơn hàng')}}
        </a>
        <form id="bulk-order-form" action="{{ route('donhang.bulkorder') }}" method="POST">
            @csrf
            <input type="hidden" id="selected-products" name="selectedOrders">
            <button type="submit" id="bulk-order-submit-btn" class="btn btn-primary">
            {{ translateText('Huỷ các đơn hàng đã chọn')}}
        </button>
        </form>
    </div>
@else
    <p>Đơn hàng của bạn đang trống.</p>
@endif

<script>
    document.getElementById('bulk-order-submit-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Ngăn gửi form tự động

        // Lấy danh sách sản phẩm đã chọn
        let selectedOrders = [];

        document.querySelectorAll('.select-product-checkbox:checked').forEach(function (checkbox) {
            let productId = checkbox.value; // Mã sản phẩm

            // Đưa cả mã sản phẩm và số lượng vào mảng
            selectedOrders.push({
                id: productId,
            });
        });
        
        // Gửi dữ liệu nếu có sản phẩm được chọn
        if (selectedOrders.length > 0) {
            // Hiển thị thông báo xác nhận trước khi gửi form
            Swal.fire({
                title: 'Bạn có chắc chắn muốn huỷ các đơn hàng đã chọn không?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, tôi muốn huỷ!',
                cancelButtonText: 'Không, quay lại'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('selected-products').value = JSON.stringify(selectedOrders);
                    // Nếu người dùng chọn "Có", submit form
                    // Xác định rõ ràng phương thức POST
                    const form = this;

                    //alert(form.method.toUpperCase());
                    if (form.method.toUpperCase() === 'POST') {
                        // In ra phương thức và action của form để kiểm tra
                        document.getElementById('bulk-order-form').submit(); // Gửi form
                    } else {
                        console.error("Form không được cấu hình đúng với phương thức POST.");
                    }
                }
            });
        } else {
            Swal.fire({
                title: 'Vui lòng chọn ít nhất một đơn hàng để huỷ.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    });

    document.getElementById('cancel-all-orders').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ a

        Swal.fire({
            title: 'Bạn có chắc chắn muốn huỷ tất cả đơn hàng không?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, huỷ tất cả!',
            cancelButtonText: 'Không, quay lại'
        }).then((result) => {
            if (result.isConfirmed) {
                // Chuyển hướng người dùng đến URL nếu họ xác nhận
                window.location.href = "{{ route('donhang.cancel') }}";
            }
        });
    });
</script>