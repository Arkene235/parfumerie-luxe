<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index');
        }
        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        $total = 0;
        foreach ($cart as $id => $quantity) {
            if (isset($products[$id])) {
                $total += $products[$id]->price * $quantity;
            }
        }
        return Inertia::render('Checkout/Index', ['total' => $total]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'stripeToken' => 'required',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        $total = 0;
        foreach ($cart as $id => $quantity) {
            if (isset($products[$id])) {
                $total += $products[$id]->price * $quantity;
            }
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $total * 100, // in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Order payment',
            ]);

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'paid',
                'stripe_payment_id' => $charge->id,
            ]);

            // Create order items
            foreach ($cart as $id => $quantity) {
                if (isset($products[$id])) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'quantity' => $quantity,
                        'price' => $products[$id]->price,
                    ]);
                }
            }

            // Clear cart
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Order placed successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
