@extends('app')

@section('content')
        <div class="view center center-text">
        @if($user) 
            <span>{{ __('app.account-activated-success', ['name' => $user->name]) }}. {!! __('app.click-here') !!}.</span>
        @else
            <span>{{ __('app.account-activated-false') }}. {!! __('app.click-here') !!}.</span>
        @endif
        </div>
@endsection. 