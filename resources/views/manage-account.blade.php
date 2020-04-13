{!! __('email.manage-account-1', [
    'name' => $help->name,
    'title' => $help->title
]) !!}
<a href="{{ env('APP_URL') }}/edithelp/{{ $help->token }}">{{ env('APP_URL') }}/edithelp/{{ $help->token }}</a>.<br><br>
{!! __('email.manage-account-2') !!}
<a href="{{ env('APP_URL') }}/deletehelp/{{ $help->token }}">{{ env('APP_URL') }}/deletehelp/{{ $help->token }}</a>.
{!! __('email.signing') !!}