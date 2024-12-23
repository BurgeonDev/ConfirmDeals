<?php

namespace App\Http\Controllers;

use App\Models\Easypaisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class EasypaisaController extends Controller
{

    public function makePayment(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $packageName = $request->packageName;
        $productPrice = $request->amount;



        $storeId = env('EASYPAISA_STORE_ID');
        $postBackURL = env('EASYPAISA_POST_BACK_URL');
        $secretKey = env('EASYPAISA_SECRET_KEY');


        $txnRefNo = 'PS-' . uniqid();

        $orderRefNum = $txnRefNo;


        $hashString = $storeId . $orderRefNum . $productPrice . $postBackURL . $secretKey;

        $merchantHashedReq = base64_encode(hash_hmac('sha256', $hashString, $secretKey, true));

        // Create record in Easypaisa table
        Easypaisa::create([
            'user_id' => Auth::id(),
            'phone' => Auth::user()->phone_number,
            'package_name' => $packageName,
            'payment' => $productPrice,
            'transaction_reference' => $txnRefNo,
            'status' => 'pending',
        ]);


        $postData = [
            'orderId' => $txnRefNo,
            'storeId' => $storeId,
            'postBackURL' => $postBackURL,
            'orderRefNum' => $orderRefNum,
            'merchantHashedReq' => $merchantHashedReq,
            'autoRedirect' => 0,
            'transactionType' => 'MA',
        ];


        return view('frontend.pricing.checkouteasypaisa', [
            'packageName' => $packageName,
            'productPrice' => $productPrice,
            'postData' => $postData,
        ]);
    }
}
