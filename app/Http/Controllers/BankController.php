<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BankController extends Controller

{

    public function index(Request $request)
    {
        return view('index');
    }

    public function getBank(Request $request)
    {

        $ch = curl_init();

        $headers = [
            'Authorization: Bearer ca5723130d3042eea0a6e6b7a97d0001',
            'accept: application/json',
        ];
        curl_setopt($ch, CURLOPT_URL, 'https://sample.apigw.opencanvas.ne.jp/hiroshimabank_retail/v1/accounts/00100010100001000000000000000000');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $jsonResponse = json_decode($response, true)['accounts'][0];
        // dd($jsonResponse);
        // return response()->json([
        //     'accounts' => $jsonResponse,
        // ]);
        return view('acc_info')->with('account', $jsonResponse);
    }
}
