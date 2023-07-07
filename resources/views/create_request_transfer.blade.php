@foreach ($accounts as $account)

<form id="transfer" action="{{ route('storeTransfer') }}" method="POST">
    @csrf

<label for="">Account_id:</label>
<input style ="border: none" name="account_id" readonly value="{{ $account['account_id']}}">  <br/>

<label for="">Account:</label>
<input style ="border: none" name="account" readonly value="{{ $account['account']}}"><br/>

<label for="">Branch_name_kana</label>
<input style ="border: none" name="branch_name_kana" readonly value="{{ $account['branch_name_kana']}}"><br/>

<label for="">branch_name_kanji</label>
<input style ="border: none" name="branch_name_kanji" readonly value="{{ $account['branch_name_kanji']}}"><br/>


<label for="">account_type</label>
<input style ="border: none" name="account_type" readonly value="{{ $account['account_type']}}"><br/>

<label for="">account_number</label>
<input style ="border: none" name="account_number" readonly value="{{ $account['account_number']}}"><br/>

@foreach ( $account['remitter_info'] as $remitter_info)

<label for="">remitter_code</label>
<input style ="border: none" name="remitter_code" readonly value="{{ $remitter_info['remitter_code']}}"><br/>

@foreach ( $remitter_info['remitter_name_info'] as $remitter_name_info)

<label for="">remitter_name</label>
<input style ="border: none" name="remitter_name" readonly value="{{ $remitter_name_info['remitter_name']}}"> <button type="submit" class="btn-primary mt-3">Create request transfer</button><br/>

@endforeach
@endforeach
<hr>
</form>
@endforeach


