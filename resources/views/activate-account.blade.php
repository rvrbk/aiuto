{!! __('email.activate-account', ['name' => $user->name]) !!}
<a href="{{ env('APP_URL') }}/activateaccount/{{ $token }}">{{ env('APP_URL') }}/activateaccount/{{ $token }}</a>
{!! __('email.signing') !!}