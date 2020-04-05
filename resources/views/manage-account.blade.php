Hello {{ $help->name }},
<br><br>
You can manage your call '{{ $help->title }}' with the links below.
<br><br>
To edit your call click <a href="{{ env('APP_URL') }}/edithelp/{{ $help->token }}">here</a>.<br>
To remove your call click <a href="{{ env('APP_URL') }}/deletehelp/{{ $help->token }}">here</a>.
<br><br>
With kind regards,
<br><br>
The Cabhair team.