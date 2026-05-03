<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from andit.co/projects/html/and-tour/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Jan 2023 22:08:06 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>Home - Andtourtravel </title>
    <!-- Bootstrap css -->
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
    background: url('{{ asset("assets/img/banner/banner-three.png") }}') no-repeat center center/cover;
    position: relative;
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
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Our best promotional tours</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="promotional_tour_slider owl-theme owl-carousel dot_style">
                        {{-- @foreach($rooms as $room)

<div class="theme_common_box_two img_hover">

    
    <div class="theme_two_box_img">
        <a href="{{ route('rooms.show', $room->id) }}">
            <img src="{{ asset('images/' . $room->image) }}" alt="room image">
        </a>

        <p>
            <i class="fas fa-map-marker-alt"></i>
            {{ $room->building->location }}
        </p>
    </div>

    <div class="theme_two_box_content">

        <h4>
            <a href="{{ route('rooms.show', $room->id) }}">
                {{ $room->room_name }}
            </a>
        </h4>

        <p>
            <strong>Owner:</strong>
            {{ $room->building->landlord->firstname }}
            {{ $room->building->landlord->lastname }}
        </p>

  
        <p>
            @if($room->status == 'available')
                <span class="badge bg-success">Available</span>
            @elseif($room->status == 'occupied')
                <span class="badge bg-danger">Occupied</span>
            @else
                <span class="badge bg-warning">Pending</span>
            @endif
        </p>

        <h3>
            Tzs {{ $room->price }}
            <span>Price per month</span>
        </h3>

    </div>

</div>

@endforeach --}}
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel1.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>New beach, Thailand</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Kantua hotel, Thailand</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel2.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Indonesia</p>
                                <div class="discount_tab">
                                    <span>50%</span>
                                </div>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Hotel paradise international</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel3.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Kualalampur</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Hotel kualalampur</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel4.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Mariana island</p>
                                <div class="discount_tab">
                                    <span>50%</span>
                                </div>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Hotel deluxe</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel6.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Beach view</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Thailand grand suit</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel7.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Long island</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Zefi resort and spa</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel4.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Mariana island</p>
                                <div class="discount_tab">
                                    <span>50%</span>
                                </div>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Hotel deluxe</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel6.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Beach view</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Thailand grand suit</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.html"><img src="assets/img/tab-img/hotel7.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Long island</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.html">Zefi resort and spa</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                            <h3> <a href="tel:+00-123-456-789">+00 123 456 789</a></h3>
                        </div>
                        <div class="footer_inquery_area">
                            <h5>Mail to our support team</h5>
                            <h3> <a href="mailto:support@domain.com">support@domain.com</a></h3>
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
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="testimonials.html">Testimonials</a></li>
                            <li><a href="faqs.html">Rewards</a></li>
                            <li><a href="terms-service.html">Work with Us</a></li>
                            <li><a href="tour-guides.html">Meet the Team </a></li>
                            <li><a href="news.html">Blog</a></li>
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
                            <li><a href="top-destinations-details.html">Community program</a></li>
                            <li><a href="top-destinations-details.html">Investor Relations</a></li>
                            <li><a href="flight-search-result.html">Rewards Program</a></li>
                            <li><a href="room-booking.html">PointsPLUS</a></li>
                            <li><a href="testimonials.html">Partners</a></li>
                            <li><a href="hotel-search.html">List My Hotel</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="footer_heading_area">
                        <h5>Top cities</h5>
                    </div>
                    <div class="footer_link_area">
                        <ul>
                            <li><a href="room-details.html">Chicago</a></li>
                            <li><a href="hotel-details.html">New York</a></li>
                            <li><a href="hotel-booking.html">San Francisco</a></li>
                            <li><a href="tour-search.html">California</a></li>
                            <li><a href="tour-booking.html">Ohio </a></li>
                            <li><a href="tour-guides.html">Alaska</a></li>
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
const text = "Welcome to the House Rent Management System";
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