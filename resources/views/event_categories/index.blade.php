@extends('base')

@section('library-css')
    <link rel = "stylesheet" href = "https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <style>
        #myTable td,
        #myTable th {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class = "container-fluid">
        <div class="d-flex justify-content-between">
            <h1>Event Categories</h1>
            <a href = "{{ route('event-categories.create') }}">
                <button class = "btn btn-danger rounded-pill"><i class = "fa-solid fa-plus mr-2"></i>Add Event Categories</button>
            </a>
        </div>
        <!--Table datatable-->
        <table id="myTable" class="display compact text-center" style="width:100%">
            <thead class = "text-center">
                <tr>
                    <th>ID</th>
                    <th>Event Category</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event_categories as $event_category)
                    <tr class = "h-100">
                        <td>{{ $event_category->id }}</td>
                        <td>{{ $event_category->name }}</td>
                        <td>
                            <div class = "d-flex w-100 justify-content-center">
                                <a href = "{{ route('event-categories.edit', ['event_category' => $event_category->id]) }}">
                                    <button class =  "rounded-circle btn btn-info" style = "width:40px; height:40px; ">
                                        <i class= "fa-solid fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <form action="{{ route('event-categories.destroy', ['event_category' => $event_category->id]) }}" method="POST"
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
