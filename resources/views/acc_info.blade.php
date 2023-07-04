<body>
    <h1>銀行口座</h1>
    @if(isset($account))
    <h2>
        account_name: {{ $account['account_name'] }}
        <br>
        branch_name: {{ $account['branch_name'] }}
        <br>
        account_number: {{ $account['account_number'] }}
        <br>
        current_balance: {{ $account['current_balance'] }}円
    </h2>
    @endif