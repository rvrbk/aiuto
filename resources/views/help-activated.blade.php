@extends('app')

@section('content') 
        <div class="view center center-text">
        @if($help) 
            <span>{{ __('app.help-activated-success', ['title' => $help->title]) }}. {!! __('app.click-here') !!}.</span>
        @else
            <span>{{ __('app.help-activated-fail') }}. {!! __('app.click-here') !!}.</span>
        @endif
        </div>
@endsection