<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email' => $request->email,
            'subscribed' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Merci de vous être inscrit à notre newsletter !',
        ]);
    }

    public function unsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $newsletter = Newsletter::where('email', $request->email)->first();

        if ($newsletter) {
            $newsletter->update(['subscribed' => false]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Vous avez été désinscrit de notre newsletter.',
        ]);
    }
}
