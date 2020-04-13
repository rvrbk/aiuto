{!! __('email.offer-to-caller', [
    'caller-name' => $help->name,
    'offerer-name' => $offerer->name,
    'offerer-email' => $offerer->email,
    'help-title' => $help->title,
    'offer' => $offer->offer
]) !!} 
<a href="{{ env('APP_URL') }}/match/{{ $token }}">{{ env('APP_URL') }}/match/{{ $token }}</a>
{!! __('email.signing') !!}