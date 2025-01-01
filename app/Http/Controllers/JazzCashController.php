<?php

namespace App\Http\Controllers;

use App\Models\Easypaisa;
use App\Models\JazzCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;





class JazzCashController extends Controller
{

    public function processPayment(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $packageName = $request->packageName;
        $productPrice = $request->amount;

        $merchantId = env('JAZZCASH_MERCHANT_ID');
        $password = env('JAZZCASH_PASSWORD');
        $integritySalt = env('JAZZCASH_INTEGRITY_SALT');
        $returnUrl = env('JAZZCASH_RETURN_URL');




        $ppAmount = $productPrice * 100;
        $currentDateTime = now()->format('YmdHis');
        $txnRefNo = "T" . $currentDateTime;

        // Save Payment Record
        $jazzCash = Easypaisa::create([
            'user_id' => Auth::id(),
            'phone' => Auth::user()->phone_number,
            'package_name' => $packageName,
            'payment' => $productPrice,
            'transaction_reference' => $txnRefNo,
            'status' => 'pending',
        ]);


        // Prepare post data
        $postData = [

            "pp_Version" => "1.1",
            "pp_TxnType" => "",
            "pp_Language" => "EN",
            "pp_MerchantID" => $merchantId,
            "pp_SubMerchantID" => "",
            "pp_Password" => $password,
            "pp_BankID" => "TBANK",
            "pp_ProductID" => "RETL",
            "pp_TxnRefNo" => $txnRefNo,
            "pp_Amount" => $ppAmount,
            "pp_TxnCurrency" => "PKR",
            "pp_TxnDateTime" => $currentDateTime,
            "pp_BillReference" => "billRef",
            "pp_Description" => $packageName,
            "pp_ReturnURL" => $returnUrl,
            "pp_SecureHash" => "",
            "ppmpf_1" => "1",
            "ppmpf_2" => "2",
            "ppmpf_3" => "3",
            "ppmpf_4" => "4",
            "ppmpf_5" => "5"
        ];


        ksort($postData);

        // Concatenate all values in the sorted array without keys, separated by '&'
        $concatString = '';
        foreach ($postData as $key => $value) {
            $concatString .= $value . '&';
        }

        // Remove the trailing '&'
        $concatString = rtrim($concatString, '&');

        // Generate the HMAC-SHA256 hash using the integrity salt
        $secureHash = hash_hmac('sha256', $concatString, $integritySalt);

        // Add the generated secure hash to the post data
        $postData['pp_SecureHash'] = strtoupper($secureHash); // JazzCash requires the hash to be in uppercase


        // dd($postData);
        return view('frontend.pricing.checkout', [
            'packageName' => $packageName,
            'productPrice' => $productPrice,
            'postData' => $postData,
        ]);
    }


    public function handleCallback(Request $request)
    {

        // Check if 'pp_ResponseCode' exists in the request
        if ($request->has('pp_ResponseCode')) {
            $responseCode = $request->input('pp_ResponseCode');

            if ($responseCode === '000') {
                // Success response
                return response()->json([
                    'status' => 'success',
                    'message' => 'Transaction was successful.',
                    'data' => $request->all(),
                ], 200);
            } else {
                // Failure response
                return response()->json([
                    'status' => 'failure',
                    'message' => 'Transaction failed.',
                    'data' => $request->all(),
                ], 400);
            }
        }

        // Invalid response
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid callback data.',
        ], 422);
    }
}
