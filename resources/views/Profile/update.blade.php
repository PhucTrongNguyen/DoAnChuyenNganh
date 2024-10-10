@extends('Layout.app')

@section('content')
<div class="container mt-5">
    <h3>Update Profile & Address</h3>

    <!-- Hiển thị thông báo nếu có -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form cập nhật thông tin cá nhân và địa chỉ -->
    <form action="{{ route('Profile.updateProfile') }}" method="POST" id="updateForm">
        @csrf

        <!-- Thông tin cá nhân -->
        <div class="mb-4">
            <h4>Personal Information</h4>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
            </div>
        </div>

        <!-- Địa chỉ giao hàng -->
        <div class="mb-4">
            <h4>Shipping Address</h4>
            <div class="mb-3">
                <label for="street" class="form-label">Street</label>
                <input type="text" class="form-control" id="street" name="street" value="{{ $addresses[0]->street ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label for="ward" class="form-label">Ward</label>
                <input type="text" class="form-control" id="ward" name="ward" value="{{ $addresses[0]->ward ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label for="district" class="form-label">District</label>
                <input type="text" class="form-control" id="district" name="district" value="{{ $addresses[0]->district ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $addresses[0]->city ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $addresses[0]->zip_code ?? '' }}" required>
            </div>
        </div>

        <!-- Nút submit -->
        <button type="button" class="btn btn-primary" onclick="confirmUpdate()">Update Profile & Address</button>
    </form>
</div>

<script>
    function confirmUpdate() {
        // Hiển thị hộp thoại xác nhận
        if (confirm('Are you sure you want to update your profile and address?')) {
            // Nếu người dùng xác nhận, gửi form
            document.getElementById('updateForm').submit();
        }
    }
</script>
@endsection
