    @extends('Layout.app')

    @section('content')
    <div class="container mt-5">
        <!-- Navigation -->
        <div class="row">
            <div class="col-md-3 account-nav">
                <h5>Manage My Account</h5>
                <a href="#">My Profile & Address Book</a>
                <a href="#">My Payment Options</a>
            </div>
            <div class="col-md-3 account-nav">
                <h5>My Orders</h5>
                <a href="#">My Returns</a>
                <a href="#">My Cancellations</a>
            </div>
            <div class="col-md-3 account-nav">
                <h5>My Reviews</h5>
                <a href="#">My Wishlist & Followed Stores</a>
            </div>
        </div>

        <!-- Manage My Account Section -->
        <h3 class="mt-5">Manage Personal Profile & Address Book</h3>
        <div class="row">
            <!-- Personal Profile Card -->
            <div>
                <div class="card">
                    <div class="card-header">
                        <span>Personal Profile</span>
                        <a href="{{ route('Profile.update') }}">Edit</a>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $user->name ?? 'Name of customer' }}</p>
                        <p><strong>Email:</strong> {{ $user->email ?? 'Email' }}</p>
                        <p><strong>Phone:</strong> {{ $user->phone ?? 'Phone number' }}</p>
                    </div>
                    <div class="card-header">
                        <span>Address Book</span>
                    </div>
                    <div class="card-body">
                        @if(isset($addresses) && count($addresses) > 0)
                            @foreach($addresses as $address)
                                <p><strong>Address:</strong> {{ $address->street }}, {{ $address->ward }}, {{ $address->district }},
                                    {{ $address->city }} - {{ $address->zip_code }}</p>
                            @endforeach
                        @else
                            <p>No addresses found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
