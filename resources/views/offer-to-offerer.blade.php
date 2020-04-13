{!! __('email.offer-to-offerer', [
    'offerer-name' => $offerer->name,
    'caller-name' => $help->name,
    'caller-email' => $help->email,
    'help-title' => $help->title,
    'help' => $help->help
]) !!}
{!! __('email.signing') !!}