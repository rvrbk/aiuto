Hello {{ $offerer->name }},
<br><br>
You offered to help {{ $help->name }} with {{ $help->title }}. This is greatly appreciated!
<br><br>
You can reach {{ $help->name }} at <a href="mailto:{{ $help->email }}">{{ $help->email }}</a>.
<br><br>
<strong>{{ $help->title }}</strong>
<p>{{ $help->help }}</p> 
<br><br>
With kind regards,
<br><br>
The Cabhair team.