<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('orderItems.product')->get();
        return Inertia::render('Orders/Index', ['orders' => $orders]);
    }
}
