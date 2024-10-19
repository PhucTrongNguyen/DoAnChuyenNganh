<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function orderHistory()
    {
        $pendingOrders = Order::where('status', 'pending')->get();
        $readyOrders = Order::where('status', 'ready')->get();
        $shippingOrders = Order::where('status', 'shipping')->get();
        $returnOrders = Order::where('status', 'return')->get();
        $deliveredOrders = Order::where('status', 'delivered')->get();
        $cancelledOrders = Order::where('status', 'cancelled')->get();

        return view('Order.order_history', compact('pendingOrders', 'readyOrders', 'shippingOrders', 'returnOrders', 'deliveredOrders', 'cancelledOrders'));
    }

}
