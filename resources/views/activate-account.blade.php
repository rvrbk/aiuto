Hello {{ $user->name }},
<br><br>
Because it's your first time using this service we ask you to activate your account. To do this click on the link below.
<br><br>
<a href="{{ env('APP_URL') }}/activateaccount/{{ $token }}">{{ env('APP_URL') }}/activateaccount/{{ $token }}</a>
<br><br>
With kind regards,
<br><br>
The Aiuto team.