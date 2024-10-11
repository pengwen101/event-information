@extends('base')

@section('library-css')
    <link rel = "stylesheet" href = "https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <style>
        #myTable td,
        #myTable th {
            text-align: center;
        }

        .clickable-row{
            cursor:pointer;
        }
    </style>
@endsection

@section('content')
    <div class = "container-sm p-5 mt-5">
        <div class="d-flex justify-content-between">
            <h1>Events</h1>
            <a href = "{{ route('events.create') }}">
                <button class = "btn btn-danger rounded-pill"><i class = "fa-solid fa-plus mr-2"></i>Add Event</button>
            </a>
        </div>
        <!--Table datatable-->
        <table id="myTable" class="display compact text-center" style="width:100%">
            <thead class = "text-center">
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
                    <tr class = "h-100 clickable-row" data-href = "{{ route('events.show', ['event' => $event->id]) }}">
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date->format('Y-m-d'). " ". $event->start_time->format('h:i A') }}</td>
                        <td>{{ $event->venue }}</td>
                        <td>{{ $event->organizer->name }}</td>
                        <td class = "description">{{ Str::limit($event->description, $limit = 50, $end = '...') }}</td>
                        <td>{{ $event->tags }}</td>
                        <td>
                            <div class = "d-flex w-100 justify-content-between">
                                <a href = "{{ route('events.edit', ['event' => $event->id]) }}">
                                    <button class =  "rounded-circle btn btn-link" style = "width:40px; height:40px; ">
                                        <i class= "fa-solid fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST"
                                    class="inline-flex no-underline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class= "rounded-circle btn btn-link"
                                        style = "width:40px; height:40px; ">
                                        <i class= "fa-solid fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>

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
                'order': [],
                // 'columnDefs': [{ width: '20%', targets: -1 }]
            });

            $(".clickable-row").each(function() {
                $(this).on('click', function() {
                    let route = $(this).attr('data-href');
                    window.location.href = route;
                })
            })

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
            $(".description").each(function() {
                $(this).html(removeHTMLTags($(this).html()));
            });


        });
    </script>
@endsection
