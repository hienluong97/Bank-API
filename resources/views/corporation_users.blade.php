@foreach ($accounts as $account)
<p>account_id :{{ $account['account_id'] }}</p>
<p>account: {{ $account['account'] }}</p>
<p>branch_name_kana : {{ $account['branch_name_kana'] }}</p>
<p>branch_name_kanji {{ $account['branch_name_kanji'] }}</p>
<p>account_type: {{ $account['account_type'] }}</p>
<p>account_number: {{ $account['account_number'] }}</p>
<p>account_type: {{ $account['account_type'] }}</p>

@foreach ( $account['remitter_info'] as $remitter_info)
<p>remitter_code :{{ $remitter_info['remitter_code'] }}</p>


@foreach ( $remitter_info['remitter_name_info'] as $remitter_name_info)
<p>remitter_name_info :{{ $remitter_name_info['remitter_name'] }}</p>


@endforeach
@endforeach
<hr>
@endforeach