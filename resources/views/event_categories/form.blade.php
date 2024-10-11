@extends('base')

@section('library-css')
@endsection

@section('content')
<div class = "container-sm p-5 mt-5">
    <h1 class = "mb-2">{{ isset($event_category) ? 'Edit Event Categories' : 'Add Event Categories' }}</h1>
    <form action = "{{ isset($event_category) ? route('event-categories.update', ['event_category'=> $event_category->id]) : route('event-categories.store') }}"
        method = "POST">
        @csrf
        @if (isset($event_category))
            @method('PUT')
        @endif
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
                <input value = "{{isset($event_category)? $event_category->name: ''}}" name = "name" type="text" class="form-control" id="name" placeholder="event_category's name">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{isset($event_category)? 'Save edit': 'Create'}}</button>
    </form>
</div>
@endsection

@section('library-js')

@endsection
