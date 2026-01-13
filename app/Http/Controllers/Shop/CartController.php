<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        $cartItems = [];
        foreach ($cart as $id => $quantity) {
            if (isset($products[$id])) {
                $cartItems[] = [
                    'product' => $products[$id],
                    'quantity' => $quantity,
                    'total' => $products[$id]->price * $quantity,
                ];
            }
        }
        return Inertia::render('Cart/Index', ['cartItems' => $cartItems]);
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);
        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');
        if ($quantity > 0) {
            $cart[$product->id] = $quantity;
        } else {
            unset($cart[$product->id]);
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);
        return redirect()->back();
    }
}
