@extends('base')

@section('library-css')
<link rel = "stylesheet" href = "https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
@endsection

@section('content')

<div class = "container-fluid">
    <div class="d-flex justify-content-between">
        <div class = "title">Events</div>
        <a href = "{{route('events.create')}}">
            <button class = "btn btn-danger">Add Event</button>

        </a>
        
    </div>



<!--Table datatable-->
<table id="myTable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Location </th>
            <th>Organizer </th>
            <th>About </th>            
            <th>Tags </th>
            <th>Action </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->venue }}</td>
                <td>{{ $event->organizer->name }}</td>
                <td class = "description">{{ Str::limit($event->description, $limit = 50, $end = '...') }}</td>               
                <td>{{ $event->tags }}</td>
                <td>
                    <a href = "{{route('events.edit', ['event'=>$event->id])}}">
                        <button class = "btn btn-info" href = >Edit
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                    </a>
                    <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST"
                        class="inline-flex no-underline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-danger"> Delete
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>



@endsection

@section('library-js')

<script type='text/javascript' src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                'order':[]
        });

        function removeHTMLTags(htmlString) {
            // Create a new DOMParser instance
            const parser = new DOMParser();
            // Parse the HTML string
            const doc = parser.parseFromString(htmlString, 'text/html');
            // Extract text content
            const textContent = doc.body.textContent || "";
            // Trim whitespace
            return textContent.trim();
        }
        $(".description").each(function(){
            $(this).html(removeHTMLTags($(this).html()));
        });

        
        });
    </script>
@endsection






