<body>
    <h1> Transaction list info </h1>
    @if(isset($transaction_list_info))

    @foreach ($transaction_list_info as $transaction)


    <p>    transaction_status: {{$transaction['transaction_status']}} </p>
    <p>    transaction_status_name: {{$transaction['transaction_status_name']}} </p>
    <p>    operation_date: {{$transaction['operation_date']}} </p>
    <p>    transaction_id: {{$transaction['transaction_id']}} </p>
    <p>    transfer_designated_date: {{$transaction['transfer_designated_date']}} </p>
    <p>    test_data_type: {{$transaction['test_data_type']}} </p>
    <p>    transaction_notes: {{$transaction['transaction_notes']}} </p>
    <p>    operator: {{$transaction['operator']}} </p>
    <p>    approval_pattern_type: {{$transaction['approval_pattern_type']}} </p>
    <p>    first_approver: {{$transaction['first_approver']}} </p>
    <p>    second_approver: {{$transaction['second_approver']}} </p>
    <p>    total_count: {{$transaction['total_count']}} </p>
    <p>    total_payment_amount: {{$transaction['total_payment_amount']}} </p>

    <form id="" action="{{ route('confirmTransaction') }}" method="POST">
        @csrf
        <input type="hidden" name="transaction_id" value="{{$transaction['transaction_id']}}">
        <button type="submit">Confirm transaction</button>
    </form>
<hr>
@endforeach
@endif

</body>