Hello {{ $help->name }},
<br><br>
{{ $offerer->name }} offered to help you!
<br><br>
You can reach {{ $offerer->name }} at <a href="mailto:{{ $offerer->email }}">{{ $offerer->email }}</a>.
<br><br>
<strong>{{ $help->title }}</strong>
<p>{{ $offer->offer }}</p>
<br><br>
Can you please let us know if it worked out by clicking the link below? 
<a href="{{ env('APP_URL') }}/match/{{ $token }}">{{ env('APP_URL') }}/match/{{ $token }}</a>
<br><br>
With kind regards,
<br><br>
The Aiuto team.