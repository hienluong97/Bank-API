<body>
    <h1> Create transfer result </h1>
    @if(isset($transfer))

    <p>    transaction_status: {{$transfer['transaction_status']}} </p>
    <p>    transaction_status_name: {{$transfer['transaction_status_name']}} </p>
    <p>    transaction_id: {{$transfer['transaction_id']}} </p>
    <p>    temporary_transaction_id: {{$transfer['temporary_transaction_id']}} </p>
    <p>    transaction_status: {{$transfer['transaction_status']}} </p>
    <p>    transaction_notes: {{$transfer['transaction_notes']}} </p>
    <p>    result_type: {{$transfer['result_type']}} </p>
    <p>    approval_expiration_date: {{$transfer['approval_expiration_date']}} </p>

    <form id="" action="{{ route('confirmTransaction') }}" method="POST">
        @csrf
        <input type="hidden" name="transaction_id" value="{{$transfer['transaction_id']}}">
        <button type="submit">Confirm transaction</button>
    </form>
    

    @endif

    ------------------
    <br>
    <br>
    <br>
    <br>

    <a href="{{ route('showListRequestTransfer') }}">Show list of requests transfer</a>

</body>