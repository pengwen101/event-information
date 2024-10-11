@extends('base')

@section('library-css')
@endsection

@section('content')
    <div class = "container-sm p-5 mt-5">
        <div class = "border rounded p-5 ">
            <h1 class = "mb-3">{{ $organizer->name }}</h1>
            <div class = "d-flex mb-3">
                <button href = '{{route('organizers.edit', ['organizer'=>$organizer->id])}}' class = "mr-3 rounded-circle" style = "width:40px; height:40px; ">
                <i class = "fa-solid fa-edit"></i>
                </button>

            <form action="{{ route('organizers.destroy', ['organizer' => $organizer->id]) }}" method="POST"
                class="inline-flex no-underline">
                @csrf
                @method('DELETE')
                <button type="submit" class= "mr-3 rounded-circle"
                    style = "width:40px; height:40px; ">
                    <i class = "fa-solid fa-trash"></i>
                </button>
            </form>

            </div>
            
            <div class = "row mb-3">
                <div class = "col-4">
                    <h5 class = "font-bold">Facebook</h5>
                </div>
                <div class = "col-8">
                    <a target = "_blank" href = '{{ $organizer->facebook_link }}' class = "color-keylime">{{ $organizer->facebook_link }}</a>
                </div>
            </div>

            <div class = "row mb-3">
                <div class = "col-4">
                    <h5 class = "font-bold">X</h5>
                </div>
                <div class = "col-8">
                    <a target = "_blank" href = '{{ $organizer->x_link }}' class = "color-keylime">{{ $organizer->x_link }}</a>
                </div>
            </div>

            <div class = "row mb-3">
                <div class = "col-4">
                    <h5 class = "font-bold">Website</h5>
                </div>
                <div class = "col-8">
                    <a target = "_blank" href = '{{ $organizer->website_link }}' class = "color-keylime">{{ $organizer->website_link }}</a>
                </div>
            </div>

            <h5 class = "font-bold">About</h5>

            <p id = "description" class = "mb-3">
                {{ $organizer->description }}
            </p>


        </div>



    </div>
@endsection


@section('library-js')
    <script>
        $(document).ready(function() {

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

            $("#description").html(removeHTMLTags($("#description").html()));

        });
    </script>
@endsection
