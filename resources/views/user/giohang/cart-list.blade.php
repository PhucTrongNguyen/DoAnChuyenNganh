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
@if (!empty($sanPhamTrongGH) && count($sanPhamTrongGH) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>{{ translateText('STT')}}</th>
                <th>{{ translateText('Ảnh')}}</th>
                <th>{{ translateText('Tên')}}</th>
                <th>{{ translateText('Số lượng')}}</th>
                <th>{{ translateText('Đơn giá')}}</th>
                <th>{{ translateText('Thành tiền')}}</th>
                <th>{{ translateText('Chức năng')}}</th>
            </tr>
        </thead>
        <tbody>
            @php    $index = 1; @endphp
            @foreach ($sanPham as $sp)
                @php
                    $product = \App\Models\SanPham::where('MaSP', $sp->MaSP)->first();
                    $total += $sp->DonGia * $sp->SoLuongSP;
                @endphp
                <tr>
                    <td>
                        <input type="checkbox" name="sanPhamDuocChon[]" value="{{ $sp->MaSP }}" class="select-product-checkbox">
                    </td>
                    <td>{{$index++}}</td>
                    <td>
                        <img src="{{ asset($sp->AnhSP) }}" width="50" height="50" alt="{{ $sp->TenSP }}">
                    </td>
                    <td>
                        {{ translateText($sp->TenSP)}}
                    </td>
                    <td>
                        <input type="number" name="quantity" class="product-quantity" data-product-id="{{ $sp->MaSP }}"
                            value="{{ $sp->SoLuongSP }}" min="1" style="width: 60px;">
                    </td>
                    <td>
                        {{ CurrencyHelper::formatCurrency($sp->DonGia, $selectedCurrency, $selectedLocale) }}
                    </td>

                    <td id="product-{{ $sp->MaSP }}-total">
                        {{ CurrencyHelper::formatCurrency($sp->ThanhTien, $selectedCurrency, $selectedLocale) }}
                    </td>
                    <td>
                        <form id="cartForm{{ $sp->MaSP }}" action="{{ route('cart.remove', $sp->MaSP) }}" method="POST"
                            onsubmit="event.preventDefault(); updateCart('{{ $sp->MaSP }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ translateText('Xoá')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        <h4>{{ translateText('Tổng tiền')}}: <span id="total-price">{{ number_format($total, 0, ',', '.') }} ₫</span></h4>
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ route('checkout.payment') }}" style="margin-right: 30px" class="btn btn-success">
            {{ translateText('Thanh toán tất cả')}}
        </a>
        <form id="bulk-payment-form" action="{{ route('checkout.bulkPayment') }}" method="POST">
            @csrf
            <input type="hidden" id="selected-products" name="selectedProducts">
            <button type="submit" class="btn btn-primary">{{ translateText('Thanh toán các sản phẩm đã chọn')}}</button>
        </form>
    </div>
@else
    <div class="w-100" style="height: 100vh">
        <p>{{ translateText('Giỏ hàng của bạn đang trống.')}}</p>
    </div>

@endif