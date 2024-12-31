<?php

namespace App\Http\Controllers;

use App\Models\Easypaisa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str; // Import Str facade
use Illuminate\Support\Facades\Auth;

class EasypayController extends Controller
{
    protected $transaction_url_1 = 'https://easypaystg.easypaisa.com.pk/easypay/Index.jsf';
    protected $transaction_url_2 = 'https://easypaystg.easypaisa.com.pk/easypay/Confirm.jsf';
    protected $storeId;
    protected $hashKey;

    public function __construct()
    {
        $this->storeId = env('EASYPAISA_STORE_ID');
        $this->hashKey = env('EASYPAISA_HASH_KEY');
    }

    public function checkoutIndex()
    {
        $uid = (string) Str::uuid();
        $transactionId = (string) Str::uuid();
        session([
            'uid' => $uid,
            'transactionId' => $transactionId,
        ]);
        return view('payment.easypaisa.index', [
            'uid' => $uid,
            'transactionId' => $transactionId,
        ]);
    }

    public function checkout(Request $request)
    {
        $post_back_url_1 = route('checkout.confirm', [
            'uid' => $request->uid,
            'transactionId' => $request->transactionId,
            'mobileNo' => $request->mobileNo,
        ]);

        $expiryDate = Carbon::now()->addHour()->format('Ymd His');

        $post_data = [
            'storeId' => $this->storeId,
            'amount' => $request->amount . '.0',
            'postBackURL' => $post_back_url_1,
            'orderRefNum' => $request->transactionId,
            'expiryDate' => $expiryDate,
            'merchantHashedReq' => '',
            'autoRedirect' => '1',
            'paymentMethod' => 'MA_PAYMENT_METHOD',
            'mobileNum' => $request->mobileNo,
        ];

        $sorted_string = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);

        $hashRequest = base64_encode(
            openssl_encrypt($sorted_string, 'aes-128-ecb', $this->hashKey, OPENSSL_RAW_DATA)
        );

        $post_data['merchantHashedReq'] = $hashRequest;

        return view('payment.easypaisa.confirm', [
            'postData' => $post_data,
            'transactionUrl1' => $this->transaction_url_1,
        ]);
    }

    public function checkoutConfirm(Request $request, $uid, $transactionId, $mobileNo)
    {
        if ($request->has('auth_token')) {
            return view('Checkout/Confirm', [
                'authToken' => $request->auth_token,
                'postBackURL' => route('checkout.success', [
                    'uid' => $uid,
                    'transactionId' => $transactionId,
                    'mobileNo' => $mobileNo,
                ]),
                'transactionUrl2' => $this->transaction_url_2,
            ]);
        }

        return redirect()->route('checkout.fail', [
            'uid' => $uid,
            'mobileNo' => $mobileNo,
            'transactionId' => $transactionId,
        ]);
    }

    public function checkoutSuccess(Request $request, $uid, $transactionId, $mobileNo, $amount)
    {
        if ($request->has('desc') && $request->desc == "0000") {
            return redirect()->route('checkout.success', [
                'uid' => $uid,
                'amount' => $amount,
                'mobileNo' => $mobileNo,
                'transactionId' => $transactionId,
            ]);
        }

        return redirect()->route('checkout.fail', [
            'uid' => $uid,
            'mobileNo' => $mobileNo,
            'transactionId' => $transactionId,
        ]);
    }
    public function index()
    {
        $userId = auth()->id();
        $transactions = Easypaisa::where('user_id', $userId)->get();
        return view('frontend.transactions.index', compact('transactions'));
    }
}
