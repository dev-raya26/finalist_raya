<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from andit.co/projects/html/and-tour/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Jan 2023 22:08:06 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>Home - Andtourtravel </title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('mystyle.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.all.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/navber.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
</head>
<style>
.hero-section {
    height: 90vh;
    background: url('{{ asset("images/img11.jpeg") }}') no-repeat center center/cover;
    position: relative;
}

.map-modal{
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.7);
    z-index:9999;
}

.map-content{
    width:80%;
    margin:5% auto;
    background:#fff;
    padding:10px;
    border-radius:10px;
    position:relative;
}

.map-content .close{
    position:absolute;
    right:10px;
    top:5px;
    font-size:25px;
    cursor:pointer;
}


.hero-section::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    top: 0;
    left: 0;
}

.hero-section .container {
    position: relative;
    z-index: 2;
}

.typing-text {
    font-size: 45px;
    font-weight: bold;
}
.theme_common_box_two{
    display: flex;
    flex-direction: column;
    height: 100%;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* IMAGE SIZE SAWA */
.theme_two_box_img{
    width: 100%;
    height: 220px; /* unaweza badili */
    overflow: hidden;
}

.theme_two_box_img img{
    width: 100%;
    height: 100%;
    object-fit: cover; /* muhimu sana */
}

/* CONTENT IKAE SAWA */
.theme_two_box_content{
    flex: 1;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* TITLE ISIPANUKE SANA */
.theme_two_box_content h4{
    min-height: 50px;
}

/* PRICE IBANWE CHINI */
.theme_two_box_content h3{
    margin-top: auto;
}
</style>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">HouseRent</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('signup') }}">Sign up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('showlogin') }}">Login</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center">
    <div class="container text-center text-white">
        <h1 class="typing-text"></h1>
        <p class="mt-3">Find your perfect home easily</p>
    </div>
</section>
    <!-- preloader Area -->
    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="lds-spinner">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Area -->


    <!--Promotional Tours Area -->
  <section id="promotional_tours" class="section_padding_top">
    <div class="container">

        <!-- Heading -->
        <div class="row">
            <div class="col-12">
                <div class="section_heading_center">
                    <h2>Karibu Upate Makazi Bora Kwa Bei Nafuu</h2>
                </div>
            </div>
        </div>

        <!-- BUILDING SLIDER -->
       <div class="row">
    <div class="col-lg-12">

        <div class="promotional_tour_slider owl-theme owl-carousel dot_style">

            @foreach($buildings as $building)

            <div class="theme_common_box_two img_hover">

                <div class="theme_two_box_img"
                     onclick="showRooms({{ $building->id }})"
                     style="cursor:pointer">

                    <img src="{{ asset('images/' . $building->image) }}"
                         style="height:250px;width:100%;object-fit:cover;">

                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $building->location }}
                    </p>

                </div>

                <div class="theme_two_box_content text-center">

                    <h4>{{ $building->name }}</h4>

                    <p>
                        <strong>Owner:</strong>
                        {{ $building->landlord->firstname }}
                        {{ $building->landlord->lastname }}
                    </p>

                    <button class="btn btn-sm btn-primary mt-2"
                            onclick="openMap('{{ $building->location }}')">
                        View Location
                    </button>

                </div>

            </div>

            @endforeach

        </div>

    </div>
</div>

        <!-- ROOMS -->
        <div class="row mt-5" id="rooms-container">

    @foreach($rooms as $room)

    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 room-item building-{{ $room->building_id }} d-none">

        <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">

            <!-- Room Image -->
            <div class="position-relative">

                <a href="{{ route('signup') }}">
                    <img src="{{ asset('images/' . $room->image) }}"
                         alt="room image"
                         style="height:250px;width:100%;object-fit:cover;">
                </a>

                <!-- Status Badge -->
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

            <!-- Card Body -->
            <div class="card-body d-flex flex-column">

                <!-- Room Name -->
                <h5 class="fw-bold mb-3">
                    {{ $room->room_number }}
                </h5>

                <!-- Location -->
                <p class="text-muted mb-2">
                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                    {{ $room->building->location }}
                </p>

                <!-- Room Size -->
                <p class="mb-2">
                    <strong>Room Size:</strong>
                    {{ $room->room_area }} m²
                </p>

                <!-- Utilities -->
                <p class="mb-4">
                    <strong>Utilities:</strong>
                    {{ $room->description }}
                </p>

                <!-- Price -->
                <div class="mt-auto d-flex justify-content-between align-items-center">

                    <div>
                        <h4 class="text-primary fw-bold mb-0">
                            Tzs {{ number_format($room->price) }}
                        </h4>

                        <small class="text-muted">
                            Per Month
                        </small>
                    </div>

                    <a href="{{ route('signup') }}"
                       class="btn btn-primary rounded-pill px-4">
                        Book Now
                    </a>

                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

    </div>

    </div> <!-- mwisho wa page content -->

<!-- MAP MODAL (WEKA HAPA CHINI SIO NDANI YA CAROUSEL) -->
<style>
.map-modal{
    display:none;
    position:fixed !important;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.7);
    z-index:999999 !important; 
}

.map-content{
    width:80%;
    margin:5% auto;
    background:#fff;
    padding:10px;
    border-radius:10px;
    position:relative;
    z-index:1000000;
}

.close{
    position:absolute;
    right:10px;
    top:5px;
    font-size:30px;
    cursor:pointer;
}
</style>
<div id="mapModal" class="map-modal">
    <div class="map-content">

        <span class="close" onclick="closeMap()">&times;</span>

        <iframe id="mapFrame"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen>
        </iframe>

    </div>
</div>
</section>

<script>

function showRooms(buildingId)
{
    document.querySelectorAll('.room-item').forEach(room => {
        room.classList.add('d-none');
    });
    let selectedRooms = document.querySelectorAll('.building-' + buildingId);

    selectedRooms.forEach(room => {
        room.classList.remove('d-none');
    });
    if(selectedRooms.length > 0){

        selectedRooms[0].scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    }

}

</script>
    <!-- Footer  -->
    <footer id="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Need any help?</h5>
                    </div>
                    <div class="footer_first_area">
                        <div class="footer_inquery_area">
                            <h5>Call 24/7 for any help</h5>
                            <h3> <a href="">tel:+255 0772 459034</a></h3>
                        </div>
                        <div class="footer_inquery_area">
                            <h5>Mail to our support team</h5>
                            <h3> <a href="mailto:support@domain.com">Raya@gmail.com</a></h3>
                        </div>
                        <div class="footer_inquery_area">
                            <h5>Follow us on</h5>
                            <ul class="soical_icon_footer">
                                <li><a href="#!"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#!"><i class="fab fa-twitter-square"></i></a></li>
                                <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#!"><i class="fab fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-6 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Company</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Testimonials</a></li>
                            <li><a href="">Rewards</a></li>
                            <li><a href="">Work with Us</a></li>
                            <li><a href="">Meet the Team </a></li>
                            <li><a href="">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Support</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="dashboard.html">Account</a></li>
                            <li><a href="faq.html">Faq</a></li>
                            <li><a href="testimonials.html">Legal</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="top-destinations.html"> Affiliate Program</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Other Services</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="#">Kutafuta Vyumba vya Kupanga</a></li>
                            <li><a href="#">Kuweka Tangazo la Chumba</a></li>
                            <li><a href="#">Jinsi ya Kupata Mpangaji</a></li>
                            <li><a href="#">Masharti ya Upangaji</a></li>
                            <li><a href="#">Wamiliki wa Nyumba (Landlords)</a></li>
                            <li><a href="#">Ongeza Chumba Chako</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Top Street</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="room-details.html">Fuoni</a></li>
                            <li><a href="hotel-details.html">Bububu</a></li>
                            <li><a href="hotel-booking.html">Mjini</a></li>
                            <li><a href="tour-search.html">Chukwani</a></li>
                            <li><a href="tour-booking.html">Ki/samaki </a></li>
                            <li><a href="tour-guides.html">Mlandege</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="copyright_left">
                        <p>Copyright © 2022 All Rights Reserved</p>
                    </div>
                </div>
                <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="copyright_right">
                        <img src="assets/img/common/cards.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="go-top">
        <i class="fas fa-chevron-up"></i>
        <i class="fas fa-chevron-up"></i>
    </div>
    <script>

function openMap(location)
{
    let modal = document.getElementById("mapModal");
    let frame = document.getElementById("mapFrame");

    let url = "https://www.google.com/maps?q=" + encodeURIComponent(location) + "&output=embed";

    frame.src = url;
    modal.style.display = "block";
    modal.style.visibility = "visible";
    modal.style.opacity = "1";
}

function closeMap()
{
    let modal = document.getElementById("mapModal");

    modal.style.display = "none";
    document.getElementById("mapFrame").src = "";
}

</script>
<script>
const text = "Welcome to the Building rent Collection System";
let index = 0;

function typeEffect() {
    if (index < text.length) {
        document.querySelector(".typing-text").innerHTML += text.charAt(index);
        index++;
        setTimeout(typeEffect, 50);
    }
}

window.onload = typeEffect;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/add-form.js') }}"></script>
<script src="{{ asset('assets/js/form-dropdown.js') }}"></script>
</body>


<!-- Mirrored from andit.co/projects/html/and-tour/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Jan 2023 22:08:35 GMT -->
</html>