@extends('app')

@section('content')
        <div class="view center">
        @if($help) 
            <form method="post">
                @csrf

                <p><label><div>{{ __('form.name') }}</div><input type="text" required name="name" value="{{ $help->name }}" placeholder="{{ __('form.name') }}"></label></p>
                <p><label><div>{{ __('form.summarize') }}</div><input type="text" required name="title" value="{{ $help->title }}" placeholder="{{ __('form.summarize') }}"></label></p>
                <p><label><div>{{ __('form.category') }}</div><select required name="category">
                    <option value=""></option>
                    @foreach($categories as $category)
                        @if($help->category == $category->id)
                            <option selected value="{{ $category->id }}">{{ __('form.' . $category->code) }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ __('form.' . $category->code) }}</option>
                        @endif
                    @endforeach
                </select></label></p>
                <p><label><div>{{ __('form.description') }}</div><textarea required name="help" placeholder="{{ __('form.description') }}">{{ $help->help }}</textarea></label></p>
                <p><input type="submit" value="{{ __('form.save') }}"></p>
            </form>
        @endif
        </div>
@endsection