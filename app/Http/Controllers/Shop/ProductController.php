<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12);
        $categories = Category::orderBy('name')->get();

        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category'])
        ]);
    }

    public function show(Product $product)
    {
        try {
            // Charger la catégorie et les avis
            $product->load('category');
            $reviews = $product->reviews()->with('user')->where('approved', true)->get();

            // S'assurer que les valeurs par défaut sont présentes et converties en nombres
            $product->rating = (float) ($product->rating ?? 0);
            $product->review_count = (int) ($product->review_count ?? 0);
            $product->price = (float) $product->price;
            $product->stock = (int) $product->stock;

            return Inertia::render('Product/Show', [
                'product' => $product,
                'reviews' => $reviews,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur dans ProductController@show: ' . $e->getMessage());
            return redirect()->route('products.index')
                ->with('error', 'Erreur lors du chargement du produit.');
        }
    }
}
