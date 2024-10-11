@extends('base')

@section('library-css')
@endsection

@section('content')
    <div class = "container-sm p-5 mt-5">
        <div class = "border rounded p-5 ">
            <div>{{ $event->eventCategory->name }}</div>
            <h1 class = "mb-3">{{ $event->title }}</h1>
            <img class="w-50 mb-3"
                src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVAxEpuawvpecIIlrHjqBOBh9euQOQKbqljw&s"></img>

            <div class = "row mb-3">
                <div class = "col-lg-5 col-md-12">
                    <h3>Organizer</h3>
                    {{ $event->organizer->name }}

                </div>
                <div class = "col-lg-5 col-md-12">
                    <h3>Booking URL</h3>
                    <a href = '{{ $event->booking_url }}' class = "color-keylime">{{ $event->booking_url }}</a>
                </div>
            </div>

            <div class = "row mb-3">
                <div class = "col-lg-5 col-md-12">
                    <h3>Date and Time</h3>
                    {{ $event->date->format('l, F d Y') . ' - ' . $event->start_time->format('h:i A') }}

                </div>
                <div class = "col-lg-5 col-md-12">
                    <h3>Location</h3>
                    {{ $event->venue }}
                </div>
            </div>

            <h3>About This Event</h3>

            <p id = "description" class = "mb-3">
                {{ $event->description }}
            </p>

            <h3>Tags</h3>

            <div id = "tags" class = "d-flex" data-tags = "{{$event->tags}}">

            </div>



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

            let tags = $("#tags").attr("data-tags").split(",");
            let res = "";
            tags.forEach(function(tag){
                res += `
                <div class = 'bg-keylime color-charcoal px-4 py-2 rounded-pill w-auto'>
                    ${tag}
                    </div>
                `;
            })

            $("#tags").html(res);
            


        });
    </script>
@endsection
