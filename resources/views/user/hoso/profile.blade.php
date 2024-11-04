@extends('user.index')
@section('content')

<section class="section">
    <div class="container mt-5">
        <!-- Navigation -->
        <div class="row">
            <div class="col-md-3 account-nav">
                <h5>{{ translateText('Manage My Account')}}</h5>
                <a href="#">{{ translateText('My Profile & Address Book')}}</a><br>
                <a href="#">{{ translateText('My Payment Options')}}</a>
            </div>
            <div class="col-md-3 account-nav">
                <h5>{{ translateText('My Orders')}}</h5>
                <a href="#">{{ translateText('My Returns')}}</a><br>
                <a href="#">{{ translateText('My Cancellations')}}</a>
            </div>
            <div class="col-md-3 account-nav">
                <h5>{{ translateText('My Reviews')}}</h5>
                <a href="#">{{ translateText('My Wishlist & Followed Stores')}}</a>
            </div>
        </div>

        <!-- Manage My Account Section -->
        <h3 class="mt-5">{{ translateText('Manage Personal Profile & Address Book')}}</h3>
        <div class="row">
            <!-- Personal Profile Card -->
            <div>
                <div class="card">
                    <div class="card-header">
                        <span>{{ translateText('Personal Profile')}}</span>
                        <a href="{{ route('hoso.edit', $kh->MaKH) }}">{{ translateText('Update')}}</a>
                        <a href="{{ route('hoso.create') }}">{{ translateText('Create')}}</a>
                    </div>
                    <div class="card-body">
                        <p><strong>{{ translateText('Name')}}:</strong> {{ $kh->TenKH ?? translateText('Name of customer') }}</p>
                        <p><strong>{{ translateText('Email')}}:</strong> {{ $kh->Email ?? translateText('Email') }}</p>
                        <p><strong>{{ translateText('Phone')}}:</strong> {{ $kh->DienThoai ?? translateText('Phone number') }}</p>
                    </div>
                    <div class="card-header">
                        <span>{{ translateText('Address Book')}}</span>
                    </div>
                    <div class="card-body">
                        @if($kh->diaChis->isEmpty())
                            <p>{{ translateText('Chưa có địa chỉ cụ thể.')}}</p>
                        @else
                            @foreach($kh->diaChis as $index => $item)
                                <p><strong>{{ translateText('Địa chỉ')}} {{ $index + 1 }}: </strong>{{ translateText($item->LoaiDC)}}, {{ $item->Duong }}, {{$item->Phuong}}, {{$item->Quan}}, {{$item->ThanhPho}}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
