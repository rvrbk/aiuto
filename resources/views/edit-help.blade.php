@extends('app')

@section('content')
        <div class="view center">
        @if($help) 
            <form method="post">
                @csrf

                <p><label><div>Your name</div><input type="text" required name="name" value="{{ $help->name }}" placeholder="Your name..."></label></p>
                <p><label><div>Summarize your call...</div><input type="text" required name="title" value="{{ $help->title }}" placeholder="Summarize your call..."></label></p>
                <p><label><div>What kind of help do you need?</div><select required name="category">
                    <option value=""></option>
                    @foreach($categories as $category)
                        @if($help->category == $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select></label></p>
                <p><label><div>I need help doing...</div><textarea required name="help" placeholder="I need help doing...">{{ $help->help }}</textarea></label></p>
                <p><input type="submit" value="save"></p>
            </form>
        @endif
        </div>
@endsection