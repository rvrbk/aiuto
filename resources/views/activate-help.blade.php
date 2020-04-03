Hello {{ $user->name }},
<br><br>
You just indicated you are in need of some assistance. To activate your call and make it visible on the map click on the link below.
<br><br>
<a href="{{ env('APP_URL') }}/activatehelp/{{ $token }}">{{ env('APP_URL') }}/activatehelp/{{ $token }}</a>
<br><br>
With kind regards,
<br><br>
The Aiuto team.