<?php

namespace App\Http\Controllers;

use App\Models\Mpesa;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Inertia\Inertia;

class MpesaSTKPUSHController extends Controller
{
    public $result_code = 1;
    public $result_desc = 'An error occured';

    // Initiate  Stk Push Request
    public function initializeSTKPush(Request $request)
    {
        $time_now = Carbon::now('Africa/Nairobi')->format('YmdHis');

        $data = [];
        \Log::info('STK DATA', [
            'timestamp' => $time_now,
            'raw' => env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $time_now,
            'password' => base64_encode(env('MPESA_SHORTCODE') . env('MPESA_PASSKEY') . $time_now),
        ]);


        $phone_number = $request->phone_number;

        if (preg_match('/^0\d{9}$/', $phone_number)) {
            $phone_number = '+254' . substr($phone_number, 1);
        }

        $timestamp = now('Africa/Nairobi')->format('YmdHis');
        $password = base64_encode(
            '174379' .
            'bfb279f9aa9bdbcf158e97dd71a467cd8e' .
            $timestamp
        );

        $data = [
            "BusinessShortCode" => "174379",
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => 1,
            "PartyA" => "254705715099",
            "PartyB" => "174379",
            "PhoneNumber" => "254705715099",
            "CallBackURL" => "https://example.com",
            "AccountReference" => "Test",
            "TransactionDesc" => "Test",
        ];

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $this->getAccessToken()
        ])
            ->post(env('MPESA_STK_ENDPOINT'), $data);

        $decoded_response = json_decode($response);

        \Log::info($data);
        \Log::info($decoded_response->errorCode);

        if (isset($decoded_response->errorCode)) {
            if ($decoded_response->errorCode) {
                return [
                    'message' => 'Could not initiate transaction, kindly try again after a few minutes'
                ];
            }
        }

        $Mpesa = new Mpesa;
        $Mpesa->checkout_request_id = $response['CheckoutRequestID'];
        $Mpesa->amount = $request['amount'];
        $Mpesa->paying_phone_number = $request['phone_number'];

        // request for MPesa PIN not made
        if (isset($decoded_response->ResponseCode)) {
            if ($decoded_response->ResponseCode > 0) {
                $Mpesa->status = 1;
                $Mpesa->save();
                return [
                    'message' => 'Could not initiate transaction, kindly try again after a few minutes'
                ];
            }
        }

        // request for MPesa PIN made successfully : the status will be the default 0!
        $Mpesa->save();

        return true;
    }

    public function getAccessToken()
    {
        $response = Http::withHeaders([
            "Authorization" => "Basic " . base64_encode(env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET'))
        ])
            ->get(env('MPESA_AUTH_ENDPOINT'));

        \Log::info($response);
        return $response['access_token'];
    }
}