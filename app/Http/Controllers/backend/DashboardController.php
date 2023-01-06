<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $order = Order::all();
        $data = [
            'process'    => $order->where('order_status', 'P')->count(),
            'ontheway'   => $order->where('order_status', 'O')->count(),
            'cancel'     => $order->where('order_status', 'C')->count(),
            'accepted'   => $order->where('order_status', 'A')->count(),
        ];
        return view('backend.dashboard',compact('data'));
    }
}
