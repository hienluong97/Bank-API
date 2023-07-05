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

    public function getBankOld(Request $request)
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

    public function getBank(Request $request)
    {
        //getManagerBankAccount: 
        $ch = curl_init();
        $headers = [
            'Authorization: Bearer 7d0e8fddb23a40a2b5f73c2771e9c4c7',
        ];
        $data = http_build_query([
            'client_id' => '22222222',
            'contractor_id' => '0000000000000000AG0123456789A001',
            'target_service' => '20',
        ]);
        $url = 'https://sample.apigw.opencanvas.ne.jp/bizsol/v1/banks/0034/users?' . $data;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $account = json_decode($response, true)['accounts'][0];

        //createTransfer: 
        $ch = curl_init();
        $headers = [
            'Authorization: Bearer 7d0e8fddb23a40a2b5f73c2771e9c4c7',
        ];
        $data = [
            'client_id' => '00000000',
            'contractor_id' => '0000000000000000AG0123456789A001',
            'temporary_transaction_id' => 'S17100700000016',
            'warning_data_fixed_flag' => true,
            'warning_check_type' => '1100000000',
            'extension_edi_utilization_flag' => true,
            'fixed_request_data' => [
                'transaction_notes' => '10月1日振込',
                'category_code' => '21',
                'remitter_code' => '1234567891',
                'remitter_name' => $account['remitter_info'][0]['remitter_name_info'][0]['remitter_name'],
                'effort_date' => '04-01',
                'remitting_bank_code' =>  0034,
                'remitting_bank_name' => 'seven bank',
                'remitting_branch_code' => '115',
                'remitting_bank_branch_name' => 'ﾄｳｷｮｳﾎﾝﾃﾝ', $account['branch_name_kana'],
                'remitting_account_type_code' => '01',
                'remitting_account_number' => $account['account_number'],
                'dummy_header' => 'ｷﾝﾕｳｷｶﾝﾚﾝｹｲｼﾞｮｳﾎｳ',
                'transactions' => [
                    [
                        'item_id' => '1',
                        'beneficiary_bank_code' => '1234',
                        'beneficiary_bank_name' => '1234ｷﾞﾝｺｳ',
                        'beneficiary_branch_code' => '115',
                        'beneficiary_branch_name' => 'ﾄｳｷｮｳﾎﾝﾃﾝ',
                        'clearing_house_number' => '0000',
                        'account_type_code' => '01',
                        'account_number' => '1100001',
                        'beneficiary_name' => '123ｼﾖｳｶｲ',
                        'transfer_amount' => 100000,
                        'new_code' => '1',
                        'customer_code1' => '0120931503',
                        'customer_code2' => '4789264425',
                        'edi_info' => '01209315034789264425',
                        'edi_xml' => [
                            '支払通知番号:1111111111111↓支払通知発行日:2018年12月25日↓',
                        ],
                        'transfer_designated_type' => '7',
                        'identification' => 'Y',
                        'dummy' => 'ﾀﾞﾐｰｴﾘｱ',
                    ],
                ],
                'total_count' => 10,
                'total_amount' => 200000,
                'dummy_trailer' => 'ｷﾝﾕｳｷｶﾝﾚﾝｹｲｼﾞｮｳﾎｳ',
                'approval_pattern_type' => 'single_approval',
                'first_approver_code' => 'Z001',
                'second_approver_code' => 'Z002',
                'comment' => 'コメント',
            ],
        ];

        $jsonData = json_encode($data);
        $url = 'https://sample.apigw.opencanvas.ne.jp/bizsol/v1/banks/0034/bulk_transfers';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($ch);
        curl_close($ch);
        $transfer = json_decode($response, true);
        // dd($transfer['transaction_id']);


        //confirnTransfer: 
        $ch = curl_init();
        $headers = [
            'Authorization: Bearer 7d0e8fddb23a40a2b5f73c2771e9c4c7',
        ];
        $confirmData = [
            'client_id' => '00000000',
            'contractor_id' => '0000000000000000AG0123456789A001',
            'use_media' => '1',
            'approval_cancel_type' => 'approval_cancel',
            'warning_check_type' => '1100000000',
            'warning_data_aprroval_flag' => true,
            'comment' => 'コメント',
        ];


        $jsonData = json_encode($confirmData);

        $url = 'https://sample.apigw.opencanvas.ne.jp/bizsol/v1/banks/0034/bulk_transfers/' . $transfer['transaction_id'] . '/submissions';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($ch);
        curl_close($ch);
        $confirmtransfer = json_decode($response, true);
        // dd($confirmtransfer);
        // $jsonResponse = json_decode($response, true)['accounts'][0];
        return view('acc_info')->with('confirmtransfer', $confirmtransfer['transaction_status_name']);
    }
}
