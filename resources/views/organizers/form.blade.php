@extends('base')

@section('library-css')
    <link rel = "stylesheet" href = "https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
   <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">
   <style>
    .label-info{    
        background-color: blue;
        padding: 5px 10px 5px 10px;
        border-radius:20px;
    }
   </style>
@endsection
@section('content')
<div class = "container-sm p-5 mt-5">
    <h1 class = "mb-2">{{ isset($organizer) ? 'Edit Organizer' : 'Add Organizer' }}</h1>
    <form action = "{{ isset($organizer) ? route('organizers.update', ['organizer'=> $organizer->id]) : route('organizers.store') }}"
        method = "POST">
        @csrf
        @if (isset($organizer))
            @method('PUT')
        @endif
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Organizer Name</label>
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
                <input value = "{{isset($organizer)? $organizer->name: ''}}" name = "name" type="text" class="form-control" id="name" placeholder="organizer's name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="facebook_link">Facebook Link</label>
                @if ($errors->has('facebook_link'))
                    <div class="text-danger">{{ $errors->first('facebook_link') }}</div>
                @endif
                <input value = "{{isset($organizer)? $organizer->facebook_link: ''}}" type="text" name = "facebook_link" class="form-control" id="facebook_link" placeholder="Facebook Link">
            </div>
            <div class="form-group col-md-6">
                <label for="x_link">X Link</label>
                @if ($errors->has('x_link'))
                    <div class="text-danger">{{ $errors->first('x_link') }}</div>
                @endif
                <input value = "{{isset($organizer)? $organizer->x_link : ''}}" type="text" class="form-control" name = "x_link" id="x_link">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="website_link">Website Link</label><br>
                @if ($errors->has('website_link'))
                    <div class="text-danger">{{ $errors->first('website_link') }}</div>
                @endif
                <input value = "{{isset($organizer)? $organizer->website_link :''}}" type="text" class="form-control" name = "website_link" id="website_link">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">About</label>
            @if ($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
            <textarea class="editor" id = "description" name="description">{{ isset($organizer) ? $organizer->description : '' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{isset($organizer)? 'Save edit': 'Create'}}</button>
    </form>
    <div class = "container-sm p-5">


    {{-- 
    ['name'=>'Kids Education Expo 2024', 
            'facebook_link'=>'The Westin',
            'date'=>'2024-10-21',
            'x_link'=>'09:00:00',
            'description'=>$faker->text(),
            'booking_url'=>$faker->url(),
            'tags'=>'Kids Expo, Education Expo',
            'organizer_id'=>rand(1,5),
            'website_link_id'=>rand(1,3),
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')], --}}
@endsection

@section('library-js')
    @vite('resources/js/tinymce.js')
    <script src = "https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $(document).ready(function(){
            let tags = "{{isset($organizer) ? $organizer->tags : ''}}";
            $('#tags').tagsinput('add', tags); 
        });
    </script>
@endsection
