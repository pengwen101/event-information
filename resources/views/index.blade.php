@extends('base')

@section('library-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
         .swiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 300px;
            height: fit-content;
        }

        .swiper-slide .event-card {
            display: block;
            width: 100%;
        }

        .clickable-row{
            cursor:pointer;
        }

        
    </style>
@endsection

@section('content')
    <div class = "container-sm d-flex min-vh-100 w-100 justify-content-center align-items-center">
        <div class = "d-flex w-100">
            <div class = "d-flex w-50 p-5 flex-column-reverse justify-content-center align-items-start">
                <button class = "to-below btn-keylime px-4 py-2 rounded-pill mt-2">
                    Explore Events
                </button>
                <h1 class = "hello">HELLO</h1>
            </div>

            <div class="w-75 swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($events as $event)
                        <div class="swiper-slide">
                            <div class="event-card rounded w-100 h-auto clickable-row" data-href = "{{ route('events.show', ['event' => $event->id]) }}">
                                <img class="w-100"
                                src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVAxEpuawvpecIIlrHjqBOBh9euQOQKbqljw&s"
                                    alt="Card image cap">
                                <div class="p-3 position-relative">
                                    <div class = "position-absolute blured-square"></div>
                                    <div class = "postion-absolute event-details d-flex flex-row justify-content-baseline">
                                        <div
                                            class = "z-3 position-relative w-25 p-3 d-flex flex-column mr-2 text-center border-right">
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
    
            </div>
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
                    <div class="event-card rounded w-100 h-auto clickable-row" data-href = "{{ route('events.show', ['event' => $event->id]) }}">
                        <img class="w-100"
                        src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVAxEpuawvpecIIlrHjqBOBh9euQOQKbqljw&s"
                            alt="Card image cap">
                        <div class="p-3 position-relative">
                            <div class = "position-absolute blured-square"></div>
                            <div class = "postion-absolute event-details d-flex flex-row justify-content-baseline">
                                <div
                                    class = "z-3 position-relative w-25 p-3 d-flex flex-column mr-2 text-center border-right">
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

            $(".clickable-row").each(function() {
                $(this).on('click', function() {
                    let route = $(this).attr('data-href');
                    window.location.href = route;
                })
            })



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
