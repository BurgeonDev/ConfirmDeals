<?php

namespace App\Http\Controllers;

use AKCybex\JazzCash\Facades\JazzCash;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    // PaymentController.php
    public function pay(Request $request, $bidId)
    {
        $bid = Bid::findOrFail($bidId);
        $user = Auth::user();

        // Check if the user is either the buyer or the seller
        if ($user->id === $bid->user_id) {
            $bid->user_paid = true;
        } elseif ($user->id === $bid->ad->user_id) {
            $bid->seller_paid = true;
        }

        // // If both buyer and seller have paid, update the status to 'completed'
        // if ($bid->user_paid && $bid->seller_paid) {
        //     $bid->status = 'completed';
        // }

        // Save the updated bid model
        $bid->save();

        return redirect()->back()->with('success', 'Payment successful!');
    }
}
