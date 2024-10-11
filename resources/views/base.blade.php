<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('library-css')
    @vite('resources/css/app.css')
    <style>
        :root {
            --slate: #4D5C60;
            --amythest: #525266;
            --charcoal: #383838;
            --mist: #d1e0de;
            --keylime: #eef4ce;
            --tangerine: #e44e29;
        }


        .navbar {
            background-color: var(--keylime) !important;
            color: var(--charcoal) !important;
            transition: all 0.64s ease;
        }

        .navbar * {
            color: inherit !important;
        }

        .btn-keylime {
            background-color: var(--keylime);
            color: var(--charcoal);
            border: none;
            transition: all 0.32s ease-in-out;

        }

        .btn-amythest {
            background-color: var(--amythest);
            color: var(--keylime);
            border: none;
            transition: all 0.32s ease-in-out;

        }

        .btn-keylime:hover {
            transform: scale(1.032);
            background-color: var(--tangerine);
            color: var(--keylime);
            border: none;
            font-weight: bold;
            letter-spacing: 0.032em;
        }
        .hello {
            transition: all 0.32s ease;
        }

        .to-below:hover~.hello {
            color: var(--tangerine);
            letter-spacing: 0.032em;
            transform: scale(1.032);
        }

        .bg-keylime {
            background-color: var(--keylime);
        }

        .bg-slate {
            background-color: var(--slate);
        }

        .bg-amythest {
            background-color: var(--amythest);
        }

        .bg-charcoal {
            background-color: var(--charcoal);
        }

        .bg-mist {
            background-color: var(--mist);
        }

        .bg-tangerine {
            background-color: var(--tangerine);
        }

        .color-keylime {
            color: var(--keylime);
        }

        .color-slate {
            color: var(--slate);
        }

        .color-amythest {
            color: var(--amythest);
        }

        .color-charcoal {
            color: var(--charcoal);
        }

        .color-mist {
            color: var(--mist);
        }

        .color-tangerine {
            color: var(--tangerine);
        }

        .event-card {
            position: relative;
            overflow:hidden;
        }

        .price-circle {
            position: absolute;
            top: -5%;
            left: 5%;
            cursor: default;
        }

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

        .font-extra-small {
            font-size: 10px;

        }

        .leading-tight {
            margin-bottom: -0.1rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-small {
            font-size: 12px;
        }
        .relative{
            position:relative;
        }

        .blured-square{
            position:absolute;
            top:15%;
            width:100%;
            height:5px;
            box-shadow:0 0 30px 60px var(--slate);
        }

        .event-details{
            top: -100px;
        }

        button{
            background-color: var(--keylime) !important;
            color: var(--charcoal) !important;
            border: none !important;
        }

        button:hover{
            background-color: var(--tangerine) !important;
            color: var(--keylime) !important;
            
        }

        a{
            color:var(--keylime) !important;
        }

        a:hover{
            color:var(--tangerine) !important;
        }

        h5 {
            font-weight: normal;
        }


        body {
            background-color: var(--charcoal);
            color: var(--keylime);
        }

        select{
            background-color:var(--keylime) !important;
            color: var(--charcoal) !important;
        }

        input{
            background-color:var(--slate) !important;
            color: var(--keylime) !important;
        }

        .text-danger{
            color: var(--tangerine) !important;
        }


    </style>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        {{-- <a class="navbar-brand" href="#"></a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Master Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('events.index') }}">Master Event</a>
                        <a class="dropdown-item" href="{{ route('event-categories.index') }}">Master Event Category</a>
                        <a class="dropdown-item" href="{{ route('organizers.index') }}">Master Organizer</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href='{{route('index')}}'>Events <span class="sr-only">(current)</span></a>
                </li>
            </ul>

        </div>
    </nav>

    @yield('content')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            let lastScrollTop = 0;
            $(window).on('scroll', function() {
                let currentScrollTop = $(this).scrollTop(); 
                if (currentScrollTop > lastScrollTop) {
                    $('.navbar').attr("style", "transform:translateY(-100%)")
                } else {
                    $('.navbar').attr("style", "translateY(0)");
                }
                lastScrollTop = currentScrollTop; 
            });
        });
    </script>

    @yield('library-js')

</body>

</html>
