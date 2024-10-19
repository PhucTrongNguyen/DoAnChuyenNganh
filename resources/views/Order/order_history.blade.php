@extends('Layout.app')

@section('content')
<div class="container-content">
    <main class="container mt-4">
        <h2 class="text-center mb-4">Lịch sử mua hàng</h2>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs justify-content-center" id="orderTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">Chờ xác nhận</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ready-tab" data-bs-toggle="tab" data-bs-target="#ready" type="button" role="tab" aria-controls="ready" aria-selected="false">Chờ lấy hàng</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Chờ giao hàng</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return" type="button" role="tab" aria-controls="return" aria-selected="false">Trả hàng</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="delivered-tab" data-bs-toggle="tab" data-bs-target="#delivered" type="button" role="tab" aria-controls="delivered" aria-selected="false">Đã giao</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Đã hủy</button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="orderTabContent">
            <!-- Chờ xác nhận -->
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                @if($pendingOrders->isNotEmpty())
                    <ul class="list-group">
                        @foreach($pendingOrders as $order)
                            <li class="list-group-item">
                                <h5 class="mb-1">Đơn hàng #{{ $order->id }}</h5>
                                <p class="mb-1">Tổng giá: <strong>${{ $order->total_price }}</strong></p>
                                <p class="mb-1">Ngày đặt: <em>{{ $order->created_at->format('d/m/Y H:i') }}</em></p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Không có đơn hàng nào đang chờ xác nhận.</p>
                @endif
            </div>

            <!-- Chờ lấy hàng -->
            <div class="tab-pane fade" id="ready" role="tabpanel" aria-labelledby="ready-tab">
                @if($readyOrders->isNotEmpty())
                    <ul class="list-group">
                        @foreach($readyOrders as $order)
                            <li class="list-group-item">
                                <h5 class="mb-1">Đơn hàng #{{ $order->id }}</h5>
                                <p class="mb-1">Tổng giá: <strong>${{ $order->total_price }}</strong></p>
                                <p class="mb-1">Ngày đặt: <em>{{ $order->created_at->format('d/m/Y H:i') }}</em></p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Không có đơn hàng nào đang chờ lấy hàng.</p>
                @endif
            </div>

            <!-- Chờ giao hàng -->
            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                @if($shippingOrders->isNotEmpty())
                    <ul class="list-group">
                        @foreach($shippingOrders as $order)
                            <li class="list-group-item">
                                <h5 class="mb-1">Đơn hàng #{{ $order->id }}</h5>
                                <p class="mb-1">Tổng giá: <strong>${{ $order->total_price }}</strong></p>
                                <p class="mb-1">Ngày đặt: <em>{{ $order->created_at->format('d/m/Y H:i') }}</em></p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Không có đơn hàng nào đang chờ giao hàng.</p>
                @endif
            </div>

            <!-- Trả hàng -->
            <div class="tab-pane fade" id="return" role="tabpanel" aria-labelledby="return-tab">
                @if($returnOrders->isNotEmpty())
                    <ul class="list-group">
                        @foreach($returnOrders as $order)
                            <li class="list-group-item">
                                <h5 class="mb-1">Đơn hàng #{{ $order->id }}</h5>
                                <p class="mb-1">Tổng giá: <strong>${{ $order->total_price }}</strong></p>
                                <p class="mb-1">Ngày đặt: <em>{{ $order->created_at->format('d/m/Y H:i') }}</em></p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Không có đơn hàng nào đang trong quá trình trả hàng.</p>
                @endif
            </div>

            <!-- Đã giao -->
            <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                @if($deliveredOrders->isNotEmpty())
                    <ul class="list-group">
                        @foreach($deliveredOrders as $order)
                            <li class="list-group-item">
                                <h5 class="mb-1">Đơn hàng #{{ $order->id }}</h5>
                                <p class="mb-1">Tổng giá: <strong>${{ $order->total_price }}</strong></p>
                                <p class="mb-1">Ngày đặt: <em>{{ $order->created_at->format('d/m/Y H:i') }}</em></p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Không có đơn hàng nào đã giao.</p>
                @endif
            </div>

            <!-- Đã hủy -->
            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                @if($cancelledOrders->isNotEmpty())
                    <ul class="list-group">
                        @foreach($cancelledOrders as $order)
                            <li class="list-group-item">
                                <h5 class="mb-1">Đơn hàng #{{ $order->id }}</h5>
                                <p class="mb-1">Tổng giá: <strong>${{ $order->total_price }}</strong></p>
                                <p class="mb-1">Ngày đặt: <em>{{ $order->created_at->format('d/m/Y H:i') }}</em></p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Không có đơn hàng nào đã hủy.</p>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
