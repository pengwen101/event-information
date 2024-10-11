@extends('base')

@section('library-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    
@endsection

@section('content')
    <div class = "d-flex min-vh-100 w-100 justify-content-center align-items-center">
        <div class = "d-flex flex-column-reverse justify-content-center align-items-center">
            <button class = "to-below btn-keylime px-4 py-2 rounded-pill mt-2">
                Explore Events
            </button>
            <h1 class = "hello">HELLO</h1>
        </div>
    </div>

    <div id = "events" class = "container min-vh-100 w-100 py-5">
        <div class = "row">
            <div class = "col-md-8 col-sm-12">
                <h1 class = "mb-4">Events in Surabaya</h1>

            </div>
            <div class = "col-md-4 col-sm-12 d-flex align-items-center">
                <input type = "text" name = "search" id = "search" class = "w-100 bg-keylime rounded-pill px-4 py-2"
                placeholder = "Search event...">
            </div>

            
        </div>
        <div class = "row gap-3 event-container">
            @foreach ($events as $event)
                <div class = "pt-3 pb-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-card rounded w-100 h-auto">
                        <img class="w-100"
                        src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVAxEpuawvpecIIlrHjqBOBh9euQOQKbqljw&s"
                            alt="Card image cap">
                        <div class="bg-slate p-3 position-relative">
                            <div class = "bg-slate position-absolute blured-square"></div>
                            <div class = "postion-absolute event-details d-flex flex-row justify-content-baseline">
                                <div
                                    class = "z-3 position-relative w-25 p-3 color-keylime d-flex flex-column mr-2 text-center border-right">
                                    <h6 class = "z-3 position-relative mb-0">{{ strtoupper(substr($event->date->format('l'), 0, 3 ))}}</h6>
                                    <h2 class = "z-3 position-relative mb-0">{{ $event->date->format('d') }}</h2>
                                    <h6 class = "z-3 position-relative">{{ strtoupper(substr($event->date->format('F'), 0, 3)) }}</h6>
                                    <h6 class = "z-3 position-relative font-extra-small">{{ $event->start_time->format('h:i A') }}</h6>
                                </div>
                                <div class = "w-75 ml-2 d-flex flex-column justify-content-center">
                                    <h6 class="z-3 position-relative card-title">{{ $event->title }}</h6>
                                    <div class = "z-3 position-relative font-small">{{ $event->venue }}</div>
                                    <div class = "z-3 position-relative font-small">{{ $event->organizer->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


        {{-- 
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($events as $event)
                    <div class="swiper-slide">
                        <div class="bg-slate event-card rounded w-100 h-auto">
                            <div class = "d-flex justify-content-center align-items-center price-circle rounded-pill bg-keylime color-charcoal"
                                style = "width:20%; height:8%;">
                                <div class = "fw-bold">FREE</div>
                            </div>
                            <img class="w-100"
                                src="data:image/jpeg;base64,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"
                                alt="Card image cap">
                            <div class="p-4">
                                <div class = "d-flex flex-row-reverse justify-content-around">
                                    <div
                                        class = "rounded p-3 bg-keylime color-charcoal d-flex flex-column mr-2 text-center justify-content-center">
                                        <h6 class = "mb-0">{{ strtoupper(substr($event->date->format('F'), 0, 3)) }}</h6>
                                        <h2>{{ $event->date->format('d') }}</h2>
                                        <h6>{{ $event->start_time->format('h:i A') }}</h6>
                                    </div>
                                    <div class = "w-75">
                                        <h6 class="card-title">{{ $event->title }}</h6>
                                        <p class="card-text">
                                        <div>{{ $event->venue }}</div>
                                        <div>{{ $event->organizer->name }}</div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div> --}}
    </div>
@endsection

@section('library-js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            document.querySelector(".to-below").addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('#events').scrollIntoView({
                    behavior: 'smooth'
                });
            });

            $("#search").on('keyup', function() {
                let keyword = $(this).val();

                $.ajax({
                    url: "{{ route('events.search') }}",
                    data: {
                        keyword: keyword
                    }, 
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        

                        console.log(response);
                        let result = "";
                        let events = response.events;
                        events.forEach(function(event){

                            // Create a new Date object from the event date
        const eventDate = new Date(event.date);
        
        // Format the date as needed
        const options = { weekday: 'long' };
        const dayOfWeek = eventDate.toLocaleDateString('en-US', options);
        const shortDayOfWeek = dayOfWeek.substring(0, 3).toUpperCase();
        const day = eventDate.getDate();
        const monthOptions = { month: 'long' };
        const month = eventDate.toLocaleDateString('en-US', monthOptions).substring(0, 3).toUpperCase();
        const startTime = event.start_time; // Assuming this is already formatted as needed
                            result += `
                                 <div class = "pt-3 pb-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="event-card rounded w-100 h-auto">
                        <img class="w-100"
                        src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVAxEpuawvpecIIlrHjqBOBh9euQOQKbqljw&s"
                            alt="Card image cap">
                        <div class="bg-slate p-3 position-relative">
                            <div class = "bg-slate position-absolute blured-square"></div>
                            <div class = "postion-absolute event-details d-flex flex-row justify-content-baseline">
                                <div
                                    class = "z-3 position-relative w-25 p-3 color-keylime d-flex flex-column mr-2 text-center border-right">
                                    <h6 class = "z-3 position-relative mb-0">${shortDayOfWeek}</h6>
                                    <h2 class = "z-3 position-relative mb-0">${day}</h2>
                                    <h6 class = "z-3 position-relative">${month}</h6>
                                    <h6 class = "z-3 position-relative font-extra-small">${startTime}</h6>
                                </div>
                                <div class = "w-75 ml-2 d-flex flex-column justify-content-center">
                                    <h6 class="z-3 position-relative card-title">${event.title}</h6>
                                    <div class = "z-3 position-relative font-small">${event.venue}</div>
                                    <div class = "z-3 position-relative font-small">${event.organizer.name}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            `;
                        });

                        $(".event-container").html(result);

                        

                    },
                    error: function(xhr, status, error) {
                        console.log("Error:", error); // Handle errors
                    }
                });

            });



            var swiper = new Swiper(".mySwiper", {
                effect: "coverflow",
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: "auto",
                loop: true,
                autoplay: {
                    delay: 1000,
                },
                coverflowEffect: {
                    rotate: 10,
                    stretch: 10,
                    depth: 100,
                    modifier: 2.5,
                    slideShadows: true,
                },


            });
        })
    </script>
@endsection
