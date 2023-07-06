
<p>target_service: {{ $corporation_info['target_service'] }}</p>
<p>approval_pattern_type: {{ $corporation_info['approval_pattern_type'] }}</p>
<p>approval_pattern_decided_amount: {{ $corporation_info['approval_pattern_decided_amount'] }}</p>

@foreach ($corporation_info['approver_info'] as $approver)
    <p>Approver User Code: {{ $approver['user_code'] }}</p>
    <p>Approver User Name: {{ $approver['user_name'] }}</p>
    <p>Credit Upper Limit per Transaction: {{ $approver['credit_upper_limit_per_transaction'] }}</p>
    <p>Credit Upper Limit per Item: {{ $approver['credit_upper_limit_per_item'] }}</p>
@endforeach

<p>fee_of_beneficiary_type: {{ $corporation_info['fee_of_beneficiary_type'] }}</p>
<p>beneficiary_name_input_enabled: {{ $corporation_info['beneficiary_name_input_enabled'] }}</p>
