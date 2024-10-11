@extends('base')

@section('library-css')
    <link rel = "stylesheet" href = "https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <style>
        #myTable td,
        #myTable th {
            text-align: center;
        }

        #myTable {
        table-layout: fixed;
        width: 100% !important;
        }
        #myTable td{
        width: auto !important;
        text-overflow: ellipsis;
        overflow: hidden;
        }
        #myTable th{
        width: auto !important;
        white-space: normal;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        }

        .clickable-row{
            cursor:pointer;
        }
        
    </style>
@endsection

@section('content')
<div class = "container-sm p-5 mt-5">
        <div class="d-flex justify-content-between">
            <h1>Organizers</h1>
            <a href = "{{ route('organizers.create') }}">
                <button class = "btn btn-danger rounded-pill"><i class = "fa-solid fa-plus mr-2"></i>Add Organizer</button>
            </a>
        </div>
        <!--Table datatable-->
        <table id="myTable" class="display compact text-center">
            <thead class = "text-center">
                <tr>
                    <th>ID</th>
                    <th>Organizer Name</th>
                    <th>Description</th>
                    <th>Facebook Link </th>
                    <th>X Link </th>
                    <th>Website Link </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizers as $organizer)
                    <tr class = "h-100 clickable-row" data-href = "{{ route('organizers.show', ['organizer' => $organizer->id]) }}">
                        <td>{{ $organizer->id }}</td>
                        <td>{{ $organizer->name }}</td>
                        <td class = "description">{{ Str::limit($organizer->description, $limit = 50, $end = '...') }}</td>
                        <td><a href = '{{ $organizer->facebook_link }}' target="_blank">{{ $organizer->facebook_link }}</a></td>
                        <td><a href = '{{ $organizer->x_link }}'  target="_blank">{{ $organizer->x_link }}</a></td>
                        <td><a href = '{{ $organizer->website_link }}'  target="_blank">{{ $organizer->website_link }}</a></td>
                        <td>
                            <div class = "d-flex w-100 justify-content-between">
                                <a href = "{{ route('organizers.edit', ['organizer' => $organizer->id]) }}">
                                    <button class =  "rounded-circle btn btn-info" style = "width:40px; height:40px; ">
                                        <i class= "fa-solid fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <form action="{{ route('organizers.destroy', ['organizer' => $organizer->id]) }}" method="POST"
                                    class="inline-flex no-underline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class= "rounded-circle btn btn-danger"
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
        <div class = "container-sm p-5">
@endsection

@section('library-js')
    <script type='text/javascript' src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                'order': [],
                'scrollX':true
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
