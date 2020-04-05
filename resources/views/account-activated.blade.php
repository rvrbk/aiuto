@extends('app')

@section('content')
        <div class="view center">
        @if($user) 
            <span>Hello {{ $user->name }}, your account has been activated. Click&nbsp;<a href="{{ env('APP_URL') }}">here</a>&nbsp;to return to Cabhair.</span>
        @else
            <span>Hi, your account could not be found. Click&nbsp;<a href="{{ env('APP_URL') }}">here</a>&nbsp;to return to Cabhair.</span>
        @endif
        </div>
@endsection