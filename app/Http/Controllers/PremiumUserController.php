<?php

namespace App\Http\Controllers;
use App\PremiumUser;
use Illuminate\Http\Request;

class PremiumUserController extends Controller
{
    
    // Every payer
    public function index()
    {
        // TODO:: WHEN IS SUBSCRIPTION GOING TO EXPIRE
        return response()->json(PremiumUser::all());
    }
    public function store(Request $request)
    {
        $order = PremiumUser::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'expires_on' => $request->expires_on
        ]);
        return response()->json([
            'data' => $order,
            'message' => $order ? 'Subscription Successful!' : 'Subscriber Error!'
        ]);
    }
    public function expiredSubers()
    {
        return response()->json(PremiumUser::where('status', 'active')->get());
    }
    // Updating after expiration
    // When to expire
    
}
