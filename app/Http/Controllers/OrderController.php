<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
    ->select('orders.*', 'users.name as userName')->orderBy('id', 'asc')->get();

    return view('orders.list', compact('orders'));
}
public function listOrderDetail($id) {
    $orderDetail = Order::with(['orderDetails.product', 'user'])->findOrFail($id);
    return view('orders.detail', compact('orderDetail'));
}
}
