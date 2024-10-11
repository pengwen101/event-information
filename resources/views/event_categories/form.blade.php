@extends('base')

@section('library-css')
@endsection

@section('content')
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
    {{-- 
    ['name'=>'Kids Education Expo 2024', 
            'venue'=>'The Westin',
            'date'=>'2024-10-21',
            'start_time'=>'09:00:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Kids Expo, Education Expo',
            'organizer_id'=>rand(1,5),
            'event_category_category_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')], --}}
@endsection

@section('library-js')

@endsection
