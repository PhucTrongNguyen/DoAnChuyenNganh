@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Personal Profile & Address Book</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <!-- Phần hồ sơ cá nhân -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
        </div>

        <h4>Address Book</h4>

        <!-- Phần sổ địa chỉ -->
        @foreach($addresses as $address)
            <div class="border p-3 mb-2">
                <p>{{ $address->street }}, {{ $address->city }}, {{ $address->state }} - {{ $address->zip_code }}</p>
                <p>{{ $address->country }}</p>
            </div>
        @endforeach

        <div class="mb-3">
            <label>Street</label>
            <input type="text" name="street" class="form-control">
        </div>
        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control">
        </div>
        <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" class="form-control">
        </div>
        <div class="mb-3">
            <label>Zip Code</label>
            <input type="text" name="zip_code" class="form-control">
        </div>
        <div class="mb-3">
            <label>Country</label>
            <input type="text" name="country" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile and Address</button>
    </form>
</div>
@endsection
