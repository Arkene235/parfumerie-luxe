<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReviewController extends \App\Http\Controllers\Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $product->id],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
                'approved' => true, // Auto-approve for simplicity
            ]
        );

        // Update product rating
        $this->updateProductRating($product);

        return redirect()->back()->with('success', 'Votre avis a été enregistré avec succès.');
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update product rating
        $this->updateProductRating($review->product);

        return redirect()->back()->with('success', 'Votre avis a été mis à jour avec succès.');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $product = $review->product;
        $review->delete();

        // Update product rating
        $this->updateProductRating($product);

        return redirect()->back()->with('success', 'Votre avis a été supprimé.');
    }

    private function updateProductRating(Product $product)
    {
        $reviews = $product->reviews()->where('approved', true);
        $avgRating = $reviews->avg('rating') ?? 0;
        $reviewCount = $reviews->count();

        $product->update([
            'rating' => round($avgRating, 2),
            'review_count' => $reviewCount,
        ]);
    }
}
