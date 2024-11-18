@extends('user.index')

@section('content')
<div class="container mt-5">
    <h3>{{ translateText('Tạo hồ sơ và địa chỉ')}}Cập nhật hồ sơ và địa chỉ</h3>

    <!-- Form cập nhật thông tin cá nhân và địa chỉ -->
    <form action="{{ route('hoso.update', $kh->MaKH) }}" method="POST" id="updateForm">
        @csrf
        @method('PUT')
        <!-- Thông tin cá nhân -->
        <div class="mb-4">
            <div class="row">
                <div class="col-6">
                    <h4>{{ translateText('Tạo hồ sơ và địa chỉ')}}Thông tin cá nhân</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $kh->TenKH }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $kh->Email }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $kh->DienThoai }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="ngaysinh" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Ngày sinh</label>
                        <input type="date" class="form-control" name="ngaysinh" id="ngaysinh" value="{{$kh->NgaySinh}}"
                            required>
                    </div>
                    <!-- Nút tạo thêm địa chỉ khác -->
                    <button type="button" id="add-address-btn" class="btn btn-primary mt-3">
                    {{ translateText('Tạo thêm địa chỉ khác')}}
                    </button>
                    <!-- Nút submit -->
                    <button type="submit" class="btn btn-primary mt-3">
                    {{ translateText('Cập nhật hồ sơ và địa chỉ')}}
                    </button>
                </div>
                <div class="col-6 address-container">
                    @if ($kh->diaChis->isEmpty())
                        <div class="mb-3 address-form">
                            <h4>{{ translateText('Tạo hồ sơ và địa chỉ')}}Địa chỉ 1</h4>
                            <input type="hidden" name="addresses[{{ $index }}][MaDC]" value="{{ $address->MaDC }}">
                            <div class="mb-3">
                                <label for="duong-0" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Đường</label>
                                <input type="text" class="form-control" id="street-0" name="addresses[0][duong]" value=""
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="thanhpho-0" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Tỉnh/Thành phố</label>
                                <select class="form-control thanhpho" id="thanhpho-0" name="addresses[0][thanhpho]"
                                    required>
                                    <option value="">{{ translateText('Tạo hồ sơ và địa chỉ')}}Chọn Tỉnh/Thành Phố</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quan-0" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Quận/Huyện</label>
                                <select class="form-control quan" id="quan-0" name="addresses[0][quan]" required>
                                    <option value="">{{ translateText('Tạo hồ sơ và địa chỉ')}}Chọn Quận/Huyện</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="phuong-0" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Phường/Xã</label>
                                <select class="form-control phuong" id="phuong-0" name="addresses[0][phuong]" required>
                                    <option value="">{{ translateText('Tạo hồ sơ và địa chỉ')}}Chọn Phường/Xã</option>
                                </select>
                            </div>
                            <!-- Loại địa chỉ (Giao hàng hoặc bổ sung) -->
                            <div class="mb-3">
                                <label for="LoaiDC-{{ $index }}" class="form-label">{{ translateText('Tạo hồ sơ và địa chỉ')}}Loại địa chỉ</label>
                                <select class="form-select" name="addresses[{{ $index }}][LoaiDC]" id="LoaiDC-{{ $index }}">
                                    <option value="shipping" {{ $address->LoaiDC == 'shipping' ? 'selected' : '' }}>{{ translateText('Tạo hồ sơ và địa chỉ')}}Giao hàng
                                    </option>
                                    <option value="supplementary" {{ $address->LoaiDC == 'supplementary' ? 'selected' : '' }}>
                                    {{ translateText('Tạo hồ sơ và địa chỉ')}}Bổ sung</option>
                                </select>
                            </div>
                        </div>

                    @else
                        @foreach($kh->diaChis as $index => $address)
                            <div class="mb-3 address-form">
                                <h4>{{ translateText('Địa chỉ')}}: {{ $index + 1 }}</h4>
                                <div class="mt-3">
                                    <label for="duong-{{ $index }}" class="form-label">{{ translateText('Đường')}}</label>
                                    <input type="text" class="form-control duong" id="street-{{ $index }}"
                                        name="addresses[{{ $index }}][street]" value="{{ $address->Duong }}" required>
                                </div>

                                <!-- Thành phố -->
                                <div class="mt-3">
                                    <label for="thanhpho-{{ $index }}" class="form-label">{{ translateText('Thành phố')}}</label>
                                    <select class="form-control thanhpho" id="thanhpho-{{ $index }}"
                                        name="addresses[{{ $index }}][thanhpho]" required>
                                        <option value="">{{ translateText('Chọn Thành phố')}}</option>
                                    </select>
                                </div>

                                <!-- Quận/huyện -->
                                <div class="mt-3">
                                    <label for="quan-{{ $index }}" class="form-label">{{ translateText('Quận/huyện')}}</label>
                                    <select class="form-control quan" id="quan-{{ $index }}"
                                        name="addresses[{{ $index }}][quan]" required>
                                        <option value="">{{ translateText('Chọn Quận/Huyện')}}</option>
                                    </select>
                                </div>

                                <!-- Phường/xã -->
                                <div class="mt-3">
                                    <label for="phuong-{{ $index }}" class="form-label">{{ translateText('Phường/Xã')}}</label>
                                    <select class="form-control phuong" id="phuong-{{ $index }}"
                                        name="addresses[{{ $index }}][phuong]" required>
                                        <option value="">{{ translateText('Chọn Phường/Xã')}}</option>
                                    </select>
                                </div>

                                <!-- Loại địa chỉ (Giao hàng hoặc bổ sung) -->
                                <div class="mb-3">
                                    <label for="LoaiDC-{{ $index }}" class="form-label">{{ translateText('Loại địa chỉ')}}</label>
                                    <select class="form-select" name="addresses[{{ $index }}][LoaiDC]" id="LoaiDC-{{ $index }}">
                                        <option value="shipping" {{ $address->LoaiDC == 'shipping' ? 'selected' : '' }}>
                                        {{ translateText('Giao hàng')}}
                                        </option>
                                        <option value="supplementary" {{ $address->LoaiDC == 'supplementary' ? 'selected' : '' }}>
                                        {{ translateText('Bổ sung')}}</option>
                                    </select>
                                </div>

                                <input type="hidden" name="addresses[{{ $index }}][id]" value="{{ $address->MaDC }}">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let locationsData = {};
    // Thêm địa chỉ mới
    let addressCount = 1; // Đếm số form địa chỉ để định danh

    function confirmUpdate() {
        // Hiển thị hộp thoại xác nhận
        if (confirm('Are you sure you want to update your profile and address?')) {
            // Nếu người dùng xác nhận, gửi form
            document.getElementById('updateForm').submit();
        }
    }

    // Tải dữ liệu JSON
    fetch('/data/vietnamAddress.json')
        .then(response => response.json())
        .then(data => {
            locationsData = data;
            populateCities(data, document.getElementById('thanhpho-0'));
        })
        .catch(error => console.error('Error loading location data:', error));

    // Hàm điền dữ liệu tỉnh/thành phố
    function populateCities(data, citySelect) {
        citySelect.innerHTML = '<option value="">Chọn Thành phố</option>'; // Reset city select
        data.forEach(city => {
            let option = document.createElement('option');
            option.value = city.Name;
            option.textContent = city.Name;
            citySelect.appendChild(option);
        });
    }

    // Hàm điền dữ liệu quận/huyện
    function populateDistricts(districts, districtSelect, cityName) {
        districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>'; // Xóa options cũ
        districtSelect.closest('.address-form').querySelector('.phuong').innerHTML = '<option value="">Chọn Phường/Xã</option>'; // Reset ward
        const city = locationsData.find(city => city.Name === cityName); // Lấy thành phố dựa trên cityId
        if (city) {
            districts.forEach(district => {
                if (district.Name !== cityName) {
                    let option = document.createElement('option');
                    option.value = district.Name;
                    option.textContent = district.Name;
                    districtSelect.appendChild(option);
                }
            });
        }
    }

    // Hàm điền dữ liệu phường/xã
    function populateWards(wards, wardSelect, districtName) {
        wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>'; // Xóa options cũ
        wards.forEach(ward => {
            if (ward.Name !== districtName) {
                let option = document.createElement('option');
                option.value = ward.Name;
                option.textContent = ward.Name;
                wardSelect.appendChild(option);
            }
        });
    }

    // Xử lý sự kiện chọn tỉnh/thành phố và quận/huyện riêng cho từng form
    document.querySelector('.address-container').addEventListener('change', function (event) {
        const target = event.target;

        if (target.classList.contains('thanhpho')) {
            const districtSelect = target.closest('.address-form').querySelector('.quan');
            const wardSelect = target.closest('.address-form').querySelector('.phuong');
            const cityId = target.value;
            const selectedCity = locationsData.find(city => city.Name === cityId);
            if (selectedCity) {
                populateDistricts(selectedCity.Districts, districtSelect, selectedCity.Name);
            } else {
                clearOptions(districtSelect);
                clearOptions(wardSelect);
            }
        }

        if (target.classList.contains('quan')) {
            const wardSelect = target.closest('.address-form').querySelector('.phuong');
            const cityId = target.closest('.address-form').querySelector('.thanhpho').value;
            const districtId = target.value;
            const selectedCity = locationsData.find(city => city.Name === cityId);
            const selectedDistrict = selectedCity?.Districts.find(district => district.Name === districtId);
            if (selectedDistrict) {
                populateWards(selectedDistrict.Wards, wardSelect, selectedDistrict.Name);
            } else {
                clearOptions(wardSelect);
            }
        }
    });

    // Hàm xóa các tùy chọn
    function clearOptions(selectElement) {
        selectElement.innerHTML = '<option value="">Chọn</option>';
    }

    document.getElementById('add-address-btn').addEventListener('click', function () {
        const addressForm = document.createElement('div');
        addressForm.classList.add('address-form');
        addressForm.innerHTML = `
        <h4>Địa chỉ ${addressCount + 1}</h4>
        <div class="mb-3">
            <label for="street-${addressCount}" class="form-label">Đường</label>
            <input type="text" class="form-control" id="street-${addressCount}" name="addresses[${addressCount}][street]" required>
        </div>
        <div class="mb-3">
            <label for="city-${addressCount}" class="form-label">Tỉnh/Thành phố</label>
            <select class="form-control thanhpho" id="thanhpho-${addressCount}" name="addresses[${addressCount}][city]" required>
                <option value="">Chọn Thành phố</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="district-${addressCount}" class="form-label">Quận/Huyện</label>
            <select class="form-control quan" id="quan-${addressCount}" name="addresses[${addressCount}][district]" required>
                <option value="">Chọn Quận/Huyện</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="ward-${addressCount}" class="form-label">Phường/Xã</label>
            <select class="form-control phuong" id="phuong-${addressCount}" name="addresses[${addressCount}][ward]" required>
                <option value="">Chọn Phường/Xã</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="LoaiDC-${addressCount}" class="form-label">Loại địa chỉ</label>
            <select class="form-select" name="addresses[${addressCount}][LoaiDC]" id="LoaiDC-${addressCount}">
                <option value="Giao hàng" {{ $address->LoaiDC == 'Giao hàng' ? 'selected' : '' }}>Giao hàng</option>
                <option value="Bổ sung" {{ $address->LoaiDC == 'Bổ sung' ? 'selected' : '' }}>Bổ sung</option>
            </select>
        </div>
        <button type="button" class="btn btn-danger remove-address-btn mt-3">Xóa địa chỉ này</button>
    `;

        document.querySelector('.address-container').appendChild(addressForm);

        // Xử lý sự kiện xóa form địa chỉ
        addressForm.querySelector('.remove-address-btn').addEventListener('click', function () {
            addressForm.remove();
        });

        // Điền dữ liệu tỉnh/thành phố cho form mới
        populateCities(locationsData, addressForm.querySelector('.thanhpho'));

        addressCount++;
    });


</script>
@endsection