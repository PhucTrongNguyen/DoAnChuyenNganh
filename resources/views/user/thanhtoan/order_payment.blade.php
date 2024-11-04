@extends('user.index')

@section('content')
<!-- Hiển thị thông báo nếu có -->

<div class="container mt-5">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h2>Thanh toán đơn hàng</h2>

    <div class="row" style="margin-top: 50px">
        <!-- Cột bên trái: Thông tin giỏ hàng -->
        <div class="col-md-7">
            <h4>Thông tin giỏ hàng</h4>
            <hr />
            @if (!empty($cart) && count($cart) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cartTotal = 0;
                                @endphp
                                @foreach ($cart as $details)
                                                @php
                                                    $itemTotal = $details['DonGia'] * $details['SoLuongSP'];
                                                    $cartTotal += $itemTotal;
                                                @endphp
                                                <tr>
                                                    <td><img style="width: 50px" src="{{ asset($details['AnhSP']) }}" alt="{{ $details['TenSP'] }}">
                                                    </td>
                                                    <td>{{ $details['TenSP'] }}</td>
                                                    <td>{{ $details['SoLuongSP'] }}</td>
                                                    <td>{{ number_format($details['DonGia'], 0, ',', '.') }} ₫</td>
                                                    <td>{{ number_format($itemTotal, 0, ',', '.') }} ₫</td>
                                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Tổng tiền của giỏ hàng -->
                        <div class="mt-3">
                            <h5><strong>Tổng tiền trong giỏ:</strong> {{ number_format($cartTotal, 0, ',', '.') }} ₫</h5>
                        </div>
            @else
                <p>Giỏ hàng của bạn đang trống.</p>
            @endif
        </div>

        <!-- Cột bên phải: Thông tin thanh toán -->
        <div class="col-md-5">
            <h4>Thông tin thanh toán</h4>
            <hr />
            <p><strong>Tổng tiền cần thanh toán:</strong> {{ number_format($total, 0, ',', '.') }} ₫</p>
            <hr />

            <div style="display: flex">
                <div style="margin: 10px">
                    <input type="radio" name="payment_method" value="Tiền mặt" checked onclick="setPaymentMethod('Tiền mặt')" />
                    <label for="">Thanh toán tiền mặt</label>
                </div>
                <div style="margin: 10px">
                    <input type="radio" name="payment_method" value="Mã QR" onclick="setPaymentMethod('Mã QR')" />
                    <label for="">Thanh toán qua QR</label>
                </div>
            </div>
            <div id="qr_bank" class="qr_bank">
                <style>
                    .qr_bank {
                        display: none;
                    }
                </style>
                <h4>Quét mã QR để chuyển khoản thanh toán</h4>
                <h5>{{ $bank_name }}</h5> <br />
                <img src="{{ $img }}" alt="qrcode" class="img-fluid" />
            </div>

            <!-- Payment Method Hidden Field -->
            

            <!-- Nút hoàn tất thanh toán -->
            <div class="mt-4">
                <form action="{{ route('checkout.paymentComplete') }}" method="POST" novalidate>
                    @csrf
                    <input type="hidden" id="payment_method" name="payment_method" value="Tiền mặt">

                    @if (!empty($cart) && count($cart) > 0)
                        @foreach ($cart as $details)
                            <input type="hidden" name="products[{{ $details['MaSP']  }}][id]" value="{{ $details['MaSP'] }}">
                            <input type="hidden" name="products[{{ $details['MaSP'] }}][name]" value="{{ $details['TenSP'] }}">
                            <input type="hidden" name="products[{{ $details['MaSP'] }}][quantity]" value="{{ $details['SoLuongSP'] }}">
                            <input type="hidden" name="products[{{ $details['MaSP'] }}][price]" value="{{ $details['DonGia'] }}">
                        @endforeach
                    @endif
                    <button type="submit" class="btn btn-success btn-lg">Đặt hàng</button>
                </form>
            </div>

        </div>
    </div>

</div>

<script>
    function setPaymentMethod(method) {
        document.getElementById('payment_method').value = method;

        if (method === 'Mã QR') {
            document.getElementById('qr_bank').style.display = 'block';
        } else {
            document.getElementById('qr_bank').style.display = 'none';
        }
    }
</script>
@endsection