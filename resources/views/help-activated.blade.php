@extends('app')

@section('content') 
        <div class="view center">
        @if($help) 
            <span>Your call '{{ $help->title }}' has been activated. Click&nbsp;<a href="{{ env('APP_URL') }}">here</a>&nbsp;to return to Cabhair.</span>
        @else
            <span>Hi, the call could not be found. Click&nbsp;<a href="{{ env('APP_URL') }}">here</a>&nbsp;to return to Cabhair.</span>
        @endif
        </div>
@endsection