<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WishlistController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with('product.category')->get();

        return Inertia::render('Wishlist/Index', [
            'wishlists' => $wishlists,
        ]);
    }

    public function store(Product $product)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Produit ajouté à votre liste de souhaits.');
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $wishlist->delete();

        return redirect()->back()->with('success', 'Produit retiré de votre liste de souhaits.');
    }

    public function toggle(Product $product)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
                           ->where('product_id', $product->id)
                           ->first();

        if ($wishlist) {
            $wishlist->delete();
            $message = 'Produit retiré de votre liste de souhaits.';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
            $message = 'Produit ajouté à votre liste de souhaits.';
        }

        return redirect()->back()->with('success', $message);
    }
}
