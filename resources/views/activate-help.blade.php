{!! __('email.activate-help', ['name' => $user->name]) !!}
<a href="{{ env('APP_URL') }}/activatehelp/{{ $token }}">{{ env('APP_URL') }}/activatehelp/{{ $token }}</a>
{!! __('email.signing') !!}