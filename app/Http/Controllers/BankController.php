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

    public function getCorporationInfo(Request $request)
    {
        //get corporation information: 
        $ch = curl_init();
        $headers = [
            'Authorization: Bearer 7d0e8fddb23a40a2b5f73c2771e9c4c7',
        ];
        $data = http_build_query([
            'client_id' => '22222222',
            'contractor_id' => '0000000000000000AG0123456789A001',
            'target_service' => '20',
        ]);
        $url = 'https://sample.apigw.opencanvas.ne.jp/bizsol/v1/banks/0034/corporations?' . $data;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $corporation_info = json_decode($response, true);
        // dd($corporation_info);
        return view('corporation_info', compact('corporation_info'));
    }


    public function getCorporationUsers(Request $request)
    {
        //get corporation BankAccount: 
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

        $accounts = json_decode($response, true)['accounts'];
        return view('corporation_users', compact('accounts'));
    }


    public function createRequestTransfer(Request $request)
    {
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
        $accounts = json_decode($response, true)['accounts'];
        return view('create_request_transfer', compact('accounts'));
    }

    public function storeTransfer(Request $request)
    {

        $remitter_name = $request->input('remitter_name');
        $remitter_code = $request->input('remitter_code');
        $remitting_bank_branch_name = $request->input('branch_name_kana');
        $remitting_account_number = $request->input('account_number');

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
                'remitter_code' =>  $remitter_code,
                'remitter_name' => $remitter_name,
                'effort_date' => '04-01',
                'remitting_bank_code' =>  0034,
                'remitting_bank_name' => 'seven bank',
                'remitting_branch_code' => '115',
                'remitting_bank_branch_name' =>   $remitting_bank_branch_name,
                'remitting_account_type_code' => '01',
                'remitting_account_number' =>    $remitting_account_number,
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
        return view('create_transfer_result')->with('transfer', $transfer);
    }


    public function showListRequestTransfer(Request $request)
    {
        $ch = curl_init();
        $headers = [
            'Authorization: Bearer 7d0e8fddb23a40a2b5f73c2771e9c4c7',
        ];
        $data = http_build_query([
            'client_id' => '00000000',
            'contractor_id' => '0000000000000000AG0123456789A001',
            'date_from' => '2023/07/05',
            'date_to' => '2023/07/07',

        ]);
        $url = 'https://sample.apigw.opencanvas.ne.jp/bizsol/v1/banks/0034/bulk_transfers/list?' . $data;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $transaction_list_info = json_decode($response, true)['transaction_list_info'];
        return view('list_transfer_confirm', compact('transaction_list_info'));
    }


    public function confirmTransaction(Request $request)
    {
        $transaction_id = $request->input('transaction_id');

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

        $url = 'https://sample.apigw.opencanvas.ne.jp/bizsol/v1/banks/0034/bulk_transfers/' . $transaction_id . '/submissions';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($ch);
        curl_close($ch);
        $confirmTransaction = json_decode($response, true);
        // dd($confirmTransaction);
        return view('transaction_confirm_result')->with('confirmTransaction', $confirmTransaction);
    }
}
