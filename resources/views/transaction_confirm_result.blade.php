<body>
    <h1>   Transaction confirm result</h1>
    @if(isset($confirmTransaction))

    <p>    result_type: {{$confirmTransaction['result_type']}} </p>
    <p>    transaction_status: {{$confirmTransaction['transaction_status']}} </p>
    <p>    transaction_status_name: {{$confirmTransaction['transaction_status_name']}} </p>
@foreach ( $confirmTransaction['transaction_error_data'] as $transaction_error_data)
<p>transaction_error_data :{{ $transaction_error_data['transaction_error_id'] }}</p>
<p>transaction_error_data :{{ $transaction_error_data['transaction_error_message'] }}</p>
@endforeach

    @foreach ( $confirmTransaction['beneficiary_info'] as $beneficiary_info)
        <p>item_id :{{ $beneficiary_info['item_id'] }}</p>
        <p>bank_code :{{ $beneficiary_info['bank_code'] }}</p>
        <p>item_id :{{ $beneficiary_info['item_id'] }}</p>
        <p>bank_code :{{ $beneficiary_info['bank_code'] }}</p>
        <p>bank_name_kana :{{ $beneficiary_info['bank_name_kana'] }}</p>
        <p>account_number :{{ $beneficiary_info['account_number'] }}</p>
        <p>beneficiary_name_kana :{{ $beneficiary_info['beneficiary_name_kana'] }}</p>
        <p>transfer_amount :{{ $beneficiary_info['transfer_amount'] }}</p>
        <p>customer_code1 :{{ $beneficiary_info['customer_code1'] }}</p>
        <p>customer_code2 :{{ $beneficiary_info['customer_code2'] }}</p>

    @endforeach
    <p>    remitter_code: {{$confirmTransaction['remitter_code']}} </p>
    @endif

   

</body>