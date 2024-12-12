<?php

namespace App\Http\Controllers;

use AKCybex\JazzCash\Facades\JazzCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function initiatePayment(Request $request)
    {
        $i = $request->all();
        Log::info('Payment Data:', $i); // Log request data for debugging
        $data = JazzCash::request()->setAmount($i['amount'])->toArray($i);

        Log::info('Payment Data to JazzCash:', $data); // Log data before sending to gateway

        return view('redirect-to-jazzcash', ['data' => $data]);
    }

    public function handleResponse(Request $request)
    {
        // Validate response hash
        $isValid = $this->validateResponseHash($request->all());

        if (!$isValid) {
            return response()->json(['message' => 'Invalid secure hash'], 400);
        }

        // Update transaction with response details
        JazzCash::where('txn_ref_no', $request->pp_TxnRefNo)->update([
            'response_code' => $request->pp_ResponseCode,
            'response_message' => $request->pp_ResponseMessage,
            'response_payload' => $request->all(),
        ]);

        return response()->json([
            'message' => 'Response processed successfully',
            'response' => $request->all(),
        ]);
    }


    private function validateResponseHash($data)
    {
        $hashKey = $data['pp_HashKey'];
        $providedHash = $data['pp_SecureHash'];
        unset($data['pp_SecureHash'], $data['pp_HashKey']);

        ksort($data);
        $hashString = $hashKey . '&' . implode('&', array_filter($data));
        $generatedHash = hash_hmac('sha256', $hashString, $hashKey);

        return hash_equals($providedHash, $generatedHash);
    }
}
