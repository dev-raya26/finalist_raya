<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Building Rent Collection System</title>

    <!-- =====================================================
         ONLINE CSS
    ====================================================== -->

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Animate CSS -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Owl Carousel -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #fff;
            color: #111;
            overflow-x: hidden;
        }


        /* =====================================================
           HERO SECTION
        ===================================================== */

        .hero-section {
            height: 100vh;

            /* HERO IMAGE - USIBADILISHE */
            background: url('{{ asset("images/build2.jpg") }}')
                no-repeat center center / cover;

            position: relative;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.60);
            top: 0;
            left: 0;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-buttons {
            position: absolute;
            top: 0;
            right: 0;
            padding: 25px;
            z-index: 10;
        }

        .hero-buttons .btn {
            border-radius: 5px;
            padding: 9px 20px;
            font-weight: 500;
        }

        .typing-text {
            font-size: 45px;
            font-weight: bold;
            line-height: 1.2;
        }

        .hero-section p {
            font-size: 20px;
        }


        /* =====================================================
           BUILDING SECTION
        ===================================================== */

        #promotional_tours {
            background: #fff;
            padding: 70px 0 80px;
        }

        .section_heading_center {
            text-align: center;
            margin-bottom: 45px;
        }

        .section_heading_center h2 {
            font-size: 34px;
            font-weight: 500;
            color: #111827;
            margin-bottom: 15px;
        }

        .section_heading_center h2::after {
            content: "";
            display: block;
            width: 200px;
            height: 2px;
            margin: 15px auto 0;
            background: #b76cff;
        }


        /* =====================================================
           BUILDING SLIDER
        ===================================================== */

        .promotional_tour_slider {
            width: 100%;
        }

        .promotional_tour_slider .owl-stage {
            display: flex;
        }

        .promotional_tour_slider .owl-item {
            display: flex;
        }

        .promotional_tour_slider .item {
            width: 100%;
            height: 100%;
        }


        /* =====================================================
           BUILDING CARD
        ===================================================== */

        .theme_common_box_two {
            width: 100%;
            height: 100%;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e8e8e8;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.10);
            transition: 0.3s ease;
        }

        .theme_common_box_two:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.14);
        }


        /* =====================================================
           BUILDING IMAGE
        ===================================================== */

        .theme_two_box_img {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .theme_two_box_img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }


        /* =====================================================
           BUILDING CONTENT
        ===================================================== */

        .theme_two_box_content {
            min-height: 290px;
            padding: 22px 16px 16px;
            text-align: center;

            display: flex;
            flex-direction: column;
        }

        .theme_two_box_content .location {
            color: #000;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .theme_two_box_content .location i {
            margin-right: 5px;
        }

        .theme_two_box_content h4 {
            font-size: 18px;
            font-weight: 600;
            color: #111;
            margin-bottom: 12px;
        }

        .theme_two_box_content .description {
            color: #222;
            font-size: 15px;
            line-height: 1.35;

            min-height: 65px;

            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;

            overflow: hidden;
        }


        /* =====================================================
           OWNER
        ===================================================== */

        .theme_two_box_content .owner {
            color: #858594;
            font-size: 14px;
            margin-top: auto;
            margin-bottom: 15px;
        }

        .theme_two_box_content .owner strong {
            color: #858594;
        }


        /* =====================================================
           VIEW LOCATION BUTTON
        ===================================================== */

        .theme_two_box_content .location-btn {
            width: 100%;
            background: #146df5;
            border: none;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        .theme_two_box_content .location-btn:hover {
            background: #0759d4;
        }


        /* =====================================================
           BOOKED BADGE
        ===================================================== */

        .booked-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 5;

            padding: 7px 12px;
            border-radius: 5px;

            background: #dc3545;
            color: #fff;

            font-size: 13px;
            font-weight: bold;
        }


        /* =====================================================
           OWL DOTS
        ===================================================== */

        .owl-theme .owl-dots {
            margin-top: 25px;
        }

        .owl-theme .owl-dot span {
            width: 10px;
            height: 10px;
        }


        /* =====================================================
           ROOMS SECTION
        ===================================================== */

        #rooms-container {
            margin-top: 70px !important;
        }

        .room-item {
            margin-bottom: 25px;
        }

        .room-item .card {
            border: none;
            border-radius: 12px !important;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.10);
            transition: 0.3s;
        }

        .room-item .card:hover {
            transform: translateY(-5px);
        }

        .room-image {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .room-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .room-item .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .room-item h5 {
            font-size: 20px;
            color: #111;
        }

        .room-item .room-price {
            font-size: 20px;
            font-weight: bold;
            color: #146df5;
        }

        .room-item .book-btn {
            background: #146df5;
            border: none;
        }


        /* =====================================================
           MAP MODAL
        ===================================================== */

        .map-modal {
            display: none;

            position: fixed !important;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.70);

            z-index: 999999 !important;

            overflow-y: auto;
        }

        .map-content {
            width: 80%;
            max-width: 1000px;

            margin: 5% auto;

            background: #fff;

            padding: 10px;

            border-radius: 10px;

            position: relative;

            z-index: 1000000;
        }

        .map-content .close {
            position: absolute;

            right: 10px;
            top: 5px;

            font-size: 30px;

            cursor: pointer;

            z-index: 20;

            color: #000;
        }

        #mapFrame {
            border-radius: 8px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        #footer_area {
            background: #111827;
            color: #fff;
            padding: 60px 0 40px;
            margin-top: 70px;
        }

        .footer_heading_area h5 {
            color: #fff;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer_inquery_area {
            margin-bottom: 20px;
        }

        .footer_inquery_area h5 {
            font-size: 15px;
            color: #ddd;
            margin-bottom: 5px;
        }

        .footer_inquery_area h3 {
            font-size: 16px;
            color: #fff;
        }

        .footer_link_area ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer_link_area li {
            color: #ddd;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .soical_icon_footer {
            display: flex;
            gap: 15px;
            list-style: none;
            padding: 0;
        }

        .soical_icon_footer li {
            font-size: 20px;
        }


        /* =====================================================
           COPYRIGHT
        ===================================================== */

        .copyright_area {
            background: #0b1220;
            color: #fff;
            padding: 20px 0;
        }

        .copyright_left p {
            margin: 0;
            font-size: 14px;
        }


        /* =====================================================
           GO TOP BUTTON
        ===================================================== */

        .go-top {
            position: fixed;

            right: 20px;
            bottom: 15px;

            width: 42px;
            height: 42px;

            background: #8e3ff0;
            color: #fff;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            z-index: 9999;

            font-size: 16px;
        }

        .go-top i:nth-child(2) {
            display: none;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 991px) {

            .typing-text {
                font-size: 38px;
            }

            .section_heading_center h2 {
                font-size: 30px;
            }

        }


        @media (max-width: 768px) {

            .hero-section {
                height: 100vh;
            }

            .hero-buttons {
                padding: 15px;
            }

            .hero-buttons .btn {
                padding: 7px 12px;
                font-size: 14px;
            }

            .typing-text {
                font-size: 30px;
            }

            .hero-section p {
                font-size: 17px;
            }

            #promotional_tours {
                padding: 50px 0;
            }

            .section_heading_center h2 {
                font-size: 26px;
            }

            .theme_two_box_img,
            .theme_two_box_img img {
                height: 230px;
            }

            .theme_two_box_content {
                min-height: 270px;
            }

            .map-content {
                width: 95%;
                margin: 10% auto;
            }

        }


        @media (max-width: 576px) {

            .typing-text {
                font-size: 25px;
            }

            .hero-buttons {
                width: 100%;
                text-align: right;
            }

            .hero-buttons .btn {
                font-size: 13px;
                padding: 6px 10px;
            }

            .section_heading_center h2 {
                font-size: 23px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     HERO SECTION
====================================================== -->

<section class="hero-section position-relative d-flex align-items-center">

    <!-- SIGN UP / LOGIN -->
    <div class="hero-buttons">

        <a href="{{ route('signup') }}"
           class="btn btn-outline-light me-2">
            Sign Up
        </a>

        <a href="{{ route('showlogin') }}"
           class="btn btn-light">
            Login
        </a>

    </div>


    <!-- HERO CONTENT -->
    <div class="container text-center text-white">

        <h1 class="typing-text"></h1>

        <p class="mt-3">
            Find your perfect home easily
        </p>

    </div>

</section>


<!-- =====================================================
     BUILDINGS SECTION
====================================================== -->

<section id="promotional_tours">

    <div class="container">


        <!-- HEADING -->
        <div class="row">

            <div class="col-12">

                <div class="section_heading_center">

                    <h2>
                        Welcome to Find Quality Housing at an Affortable price
                    </h2>

                </div>

            </div>

        </div>


        <!-- =================================================
             BUILDING SLIDER
        ================================================== -->

        <div class="row">

            <div class="col-12">

                <div class="promotional_tour_slider owl-theme">


                    @foreach($buildings as $building)

                    <div class="item">

                        <div class="theme_common_box_two">


                            <!-- BUILDING IMAGE -->

                            <div class="theme_two_box_img"

                                @if($building->status == 'Booked')

                                    style="cursor:not-allowed; opacity:0.5;"

                                @else

                                    onclick="showRooms({{ $building->id }})"
                                    style="cursor:pointer;"

                                @endif
                            >


                                <img
                                    src="{{ asset('images/' . $building->image) }}"
                                    alt="{{ $building->name }}"
                                >


                                @if($building->status == 'Booked')

                                    <span class="booked-badge">
                                        Fully Booked
                                    </span>

                                @endif


                            </div>


                            <!-- BUILDING CONTENT -->

                            <div class="theme_two_box_content">


                                <!-- LOCATION -->

                                <p class="location">

                                    <i class="fas fa-map-marker-alt"></i>

                                    {{ $building->location }}

                                </p>


                                <!-- BUILDING NAME -->

                                <h4>
                                    {{ $building->name }}
                                </h4>


                                <!-- DESCRIPTION -->

                                <p class="description">

                                    {{ $building->description }}

                                </p>


                                <!-- OWNER -->

                                <p class="owner">

                                    <strong>Owner:</strong>

                                    {{ $building->landlord->firstname }}

                                    {{ $building->landlord->lastname }}

                                </p>


                                <!-- VIEW LOCATION -->

                                <button
                                    type="button"
                                    class="location-btn"
                                    onclick="openMap('{{ $building->location }}')"
                                >
                                    View Location
                                </button>


                            </div>

                        </div>

                    </div>

                    @endforeach


                </div>

            </div>

        </div>


        <!-- =================================================
             ROOMS
        ================================================== -->

        <div class="row mt-5" id="rooms-container">


            @foreach($rooms as $room)

            <div
                class="col-lg-4 col-md-6 col-sm-12 room-item building-{{ $room->building_id }} d-none"
            >

                <div class="card shadow-sm">


                    <!-- ROOM IMAGE -->

                    <div class="room-image">

                        <a href="{{ route('book.room',$room->id) }}">

                            <img
                                src="{{ asset('images/' . $room->image) }}"
                                alt="Room image"
                            >

                        </a>


                        <!-- STATUS -->

                        <div class="position-absolute top-0 end-0 m-3">


                            @if($room->status == 'available')

                                <span class="badge bg-success px-3 py-2">
                                    Available
                                </span>


                            @elseif($room->status == 'occupied')

                                <span class="badge bg-danger px-3 py-2">
                                    Occupied
                                </span>


                            @else

                                <span class="badge bg-warning text-dark px-3 py-2">
                                    Pending
                                </span>

                            @endif


                        </div>

                    </div>


                    <!-- ROOM BODY -->

                    <div class="card-body">


                        <!-- ROOM NUMBER -->

                        <h5 class="fw-bold mb-3">

                            {{ $room->room_number }}

                        </h5>


                        <!-- LOCATION -->

                        <p class="text-muted mb-2">

                            <i class="fas fa-map-marker-alt text-danger me-2"></i>

                            {{ $room->building->location }}

                        </p>


                        <!-- ROOM SIZE -->

                        <p class="mb-2">

                            <strong>
                                Room Size:
                            </strong>

                            {{ $room->room_area }} m²

                        </p>


                        <!-- UTILITIES -->

                        <p class="mb-4">

                            <strong>
                                Utilities:
                            </strong>

                            {{ $room->description }}

                        </p>


                        <!-- PRICE -->

                        <div class="mt-auto d-flex justify-content-between align-items-center">


                            <div>

                                <h4 class="room-price mb-0">

                                    Tzs {{ number_format($room->price) }}

                                </h4>

                                <small class="text-muted">
                                    Per Month
                                </small>

                            </div>


                            <!-- BOOK -->

                            <a
                                href="{{ route('book.room',$room->id) }}"
                                class="btn btn-primary rounded-pill px-4 book-btn"
                            >
                                Book Now
                            </a>


                        </div>


                    </div>

                </div>

            </div>

            @endforeach


        </div>


    </div>

</section>


<!-- =====================================================
     MAP MODAL
====================================================== -->

<div id="mapModal" class="map-modal">

    <div class="map-content">

        <span
            class="close"
            onclick="closeMap()"
        >
            &times;
        </span>


        <iframe
            id="mapFrame"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen
            loading="lazy">
        </iframe>

    </div>

</div>


<!-- =====================================================
     FOOTER
====================================================== -->

<footer id="footer_area">

    <div class="container">

        <div class="row">


            <!-- HELP -->

            <div class="col-md-4">

                <div class="footer_heading_area">

                    <h5>
                        Need any help?
                    </h5>

                </div>


                <div class="footer_inquery_area">

                    <h5>
                        Call 24/7 for any help
                    </h5>

                    <h3>
                        +255772 70 3994
                    </h3>

                </div>


                <div class="footer_inquery_area">

                    <h5>
                        Mail to our support team
                    </h5>

                    <h3>
                        rayaally34@gmail.com
                    </h3>

                </div>


                <div class="footer_inquery_area">

                    <h5>
                        Follow us on
                    </h5>


                    <ul class="soical_icon_footer">

                        <li>
                            <i class="fab fa-facebook"></i>
                        </li>

                        <li>
                            <i class="fab fa-twitter"></i>
                        </li>

                        <li>
                            <i class="fab fa-instagram"></i>
                        </li>

                        <li>
                            <i class="fab fa-linkedin"></i>
                        </li>

                    </ul>

                </div>

            </div>


            <!-- SERVICES -->

            <div class="col-md-4">

                <div class="footer_heading_area">

                    <h5>
                        Other Services
                    </h5>

                </div>


                <div class="footer_link_area">

                    <ul>

                        <li>
                            Search for Rental Rooms
                        </li>

                        <li>
                            Post a Room Listing
                        </li>

                        <li>
                            How to Find a Tenant
                        </li>

                        <li>
                            Rental Terms and Conditions
                        </li>

                        <li>
                            Property Owners (Landlords)
                        </li>

                        <li>
                            Add Your Room
                        </li>

                    </ul>

                </div>

            </div>


            <!-- TOP STREETS -->

            <div class="col-md-4">

                <div class="footer_heading_area">

                    <h5>
                        Top Street
                    </h5>

                </div>


                <div class="footer_link_area">

                    <ul>

                        <li>
                            Fuoni
                        </li>

                        <li>
                            Bububu
                        </li>

                        <li>
                            Mjini
                        </li>

                        <li>
                            Chukwani
                        </li>

                        <li>
                            Ki/samaki
                        </li>

                        <li>
                            Mlandege
                        </li>

                    </ul>

                </div>

            </div>


        </div>

    </div>

</footer>


<!-- =====================================================
     COPYRIGHT
====================================================== -->

<div class="copyright_area">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-12">

                <div class="copyright_left">

                    <p>
                        Copyright © 2026 All Rights Reserved.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     GO TOP
====================================================== -->

<div
    class="go-top"
    onclick="window.scrollTo({top:0, behavior:'smooth'})"
>

    <i class="fas fa-chevron-up"></i>

</div>


<!-- =====================================================
     ONLINE JAVASCRIPT
====================================================== -->

<!-- jQuery -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
</script>


<!-- Bootstrap -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>


<!-- Owl Carousel -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>


<script>

    /* =====================================================
       OWL CAROUSEL
    ===================================================== */

    $(document).ready(function () {

        $(".promotional_tour_slider").owlCarousel({

            loop: false,

            margin: 12,

            nav: false,

            dots: true,

            autoplay: false,

            responsive: {

                0: {
                    items: 1
                },

                576: {
                    items: 2
                },

                992: {
                    items: 4
                }

            }

        });

    });


    /* =====================================================
       SHOW ROOMS
    ===================================================== */

    function showRooms(buildingId)
    {

        document
            .querySelectorAll('.room-item')
            .forEach(function(room) {

                room.classList.add('d-none');

            });


        let selectedRooms =
            document.querySelectorAll(
                '.building-' + buildingId
            );


        selectedRooms.forEach(function(room) {

            room.classList.remove('d-none');

        });


        if (selectedRooms.length > 0)
        {

            selectedRooms[0].scrollIntoView({

                behavior: 'smooth',

                block: 'start'

            });

        }

    }


    /* =====================================================
       GOOGLE MAP
    ===================================================== */

    function openMap(location)
    {

        let modal =
            document.getElementById("mapModal");

        let frame =
            document.getElementById("mapFrame");


        let url =
            "https://www.google.com/maps?q="
            + encodeURIComponent(location)
            + "&output=embed";


        frame.src = url;

        modal.style.display = "block";

        modal.style.visibility = "visible";

        modal.style.opacity = "1";

    }


    /* =====================================================
       CLOSE MAP
    ===================================================== */

    function closeMap()
    {

        let modal =
            document.getElementById("mapModal");


        modal.style.display = "none";


        document.getElementById("mapFrame").src = "";

    }


    /* =====================================================
       TYPING EFFECT
    ===================================================== */

    const text =
        "Welcome to the Building Rent Collection System";

    let index = 0;


    function typeEffect()
    {

        let element =
            document.querySelector(".typing-text");


        if (!element) {
            return;
        }


        if (index < text.length)
        {

            element.innerHTML +=
                text.charAt(index);

            index++;

            setTimeout(typeEffect, 50);

        }

    }


    window.addEventListener(
        "load",
        typeEffect
    );


    /* =====================================================
       CLOSE MAP WHEN CLICK OUTSIDE
    ===================================================== */

    window.addEventListener(
        "click",
        function(event)
        {

            let modal =
                document.getElementById("mapModal");


            if (event.target === modal)
            {

                closeMap();

            }

        }
    );

</script>


</body>

<<<<<<< Updated upstream
</html>
=======
</html>
>>>>>>> Stashed changes
