<?php

namespace App\Http\Controllers\Shop;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends \App\Http\Controllers\Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Code promo invalide.',
            ]);
        }

        if (!$coupon->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Ce code promo n\'est plus valide.',
            ]);
        }

        // Calculate cart total (simplified)
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $productId => $quantity) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }

        $discount = $coupon->applyDiscount($total);

        if ($discount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Ce code promo ne peut pas être appliqué à votre commande.',
            ]);
        }

        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $discount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Code promo appliqué avec succès.',
            'discount' => $discount,
            'coupon' => $coupon,
        ]);
    }

    public function remove()
    {
        session()->forget('coupon');

        return response()->json([
            'success' => true,
            'message' => 'Code promo retiré.',
        ]);
    }
}
