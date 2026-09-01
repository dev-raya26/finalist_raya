<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


   <style>

/* =========================================================
   GLOBAL RESET
========================================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html,
body {
    width: 100%;
    min-height: 100%;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    overflow-x: hidden;
}


/* =========================================================
   SIDEBAR
========================================================= */

.sidebar {
    position: fixed;
    top: 0;
    left: 0;

    width: 240px;
    height: 100vh;

    background: linear-gradient(
        180deg,
        #0f766e,
        #14b8a6
    );

    color: white;

    padding: 15px;

    z-index: 2000;

    overflow-y: auto;

    transition: left 0.3s ease;
}

.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.35);
    border-radius: 10px;
}


/* =========================================================
   SIDEBAR TITLE
========================================================= */

.sidebar h4 {
    font-size: 21px;
    white-space: nowrap;
    text-align: center;
    margin-bottom: 20px;
}


/* =========================================================
   SIDEBAR LINKS
========================================================= */

.sidebar-link {
    display: flex;
    align-items: center;

    width: 100%;

    padding: 11px 10px;

    margin-bottom: 5px;

    border-radius: 8px;

    color: white !important;

    text-decoration: none;

    transition: all 0.3s ease;
}

.sidebar-link:hover {
    background: rgba(255,255,255,0.15);

    color: white !important;

    padding-left: 15px;
}

.sidebar-link i {
    width: 25px;

    min-width: 25px;

    text-align: center;

    margin-right: 5px;
}


/* =========================================================
   NAVBAR
========================================================= */

.navbar {
    position: fixed;

    top: 0;
    left: 240px;

    width: calc(100% - 240px);

    height: 60px;

    background: #ffffff;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 20px;

    box-shadow: 0 2px 8px rgba(0,0,0,0.08);

    z-index: 1500;

    transition:
        left 0.3s ease,
        width 0.3s ease;
}


/* =========================================================
   NAVBAR LEFT
========================================================= */

.navbar-left {
    display: flex;

    align-items: center;

    gap: 10px;

    min-width: 0;
}


/* =========================================================
   NAVBAR TITLE
========================================================= */

.navbar-title {
    margin: 0;

    font-size: 24px;

    font-weight: 400;

    color: #222;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}


/* =========================================================
   SIDEBAR TOGGLE BUTTON
========================================================= */

.sidebar-toggle {
    width: 40px;
    height: 40px;

    border: none;

    background: transparent;

    color: #0f766e;

    font-size: 23px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 8px;

    cursor: pointer;

    flex-shrink: 0;

    transition: all 0.2s ease;
}

.sidebar-toggle:hover {
    background: #e9f8f6;
}


/* =========================================================
   MAIN CONTENT
========================================================= */

.main {
    margin-left: 240px;

    width: calc(100% - 240px);

    min-height: 100vh;

    padding-top: 80px;

    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 30px;

    overflow-x: hidden;

    transition:
        margin-left 0.3s ease,
        width 0.3s ease;
}


/* =========================================================
   REMOVE BOOTSTRAP CONTAINER LIMIT
========================================================= */

.main > .container,
.main > .container-fluid,
.main .container,
.main .container-fluid {

    width: 100% !important;

    max-width: none !important;

    margin-left: 0 !important;
    margin-right: 0 !important;

    padding-left: 0 !important;
    padding-right: 0 !important;
}


/* =========================================================
   DASHBOARD WRAPPERS
========================================================= */

.main .dashboard,
.main .dashboard-container,
.main .dashboard-content,
.main .content-wrapper,
.main .page-content {

    width: 100% !important;

    max-width: none !important;

    margin-left: 0 !important;
    margin-right: 0 !important;

    padding-left: 0 !important;
    padding-right: 0 !important;
}


/* =========================================================
   ROW FIX
========================================================= */

.main .row {

    width: 100%;

    margin-left: 0 !important;

    margin-right: 0 !important;
}


/* =========================================================
   DASHBOARD CARDS
========================================================= */

.cards {

    width: 100%;

    display: grid;

    grid-template-columns:
        repeat(
            4,
            minmax(0, 1fr)
        );

    gap: 15px;

    margin: 0;

    padding: 0;
}


/* =========================================================
   CARD
========================================================= */

.card {

    width: 100%;

    min-width: 0;

    min-height: 150px;

    background: #ffffff;

    padding: 15px;

    border-radius: 12px;

    border: 1px solid #ddd;

    box-shadow:
        0 3px 10px rgba(0,0,0,0.08);

    position: relative;

    overflow: hidden;
}


/* Card heading */

.card h3 {

    font-size: 18px;

    margin: 0 0 8px 0;
}


/* Card text */

.card p {

    font-size: 13px;

    color: #555;

    margin: 0;
}


/* Card icon */

.card .icon {

    position: absolute;

    right: 15px;

    top: 15px;

    font-size: 38px;

    color: #14b8a6;
}


/* =========================================================
   CHART SECTION
========================================================= */

.charts {

    width: 100%;

    display: grid;

    grid-template-columns:
        minmax(0, 2fr)
        minmax(260px, 1fr);

    gap: 15px;

    margin-top: 20px;

    padding: 0;
}


/* =========================================================
   CHART BOX
========================================================= */

.chart-box {

    width: 100%;

    min-width: 0;

    background: #ffffff;

    padding: 15px;

    border-radius: 12px;

    overflow: hidden;
}


/* Chart title */

.chart-box h3 {

    font-size: 22px;

    line-height: 1.3;

    margin-bottom: 15px;
}


/* =========================================================
   CHART CONTAINER
========================================================= */

.chart-container {

    position: relative;

    width: 100%;

    height: 300px;
}


/* Canvas */

.chart-container canvas {

    width: 100% !important;

    height: 100% !important;
}


/* =========================================================
   CURRENT USERS
========================================================= */

.user-list {

    display: flex;

    flex-direction: column;

    gap: 10px;

    width: 100%;
}


.user-card {

    width: 100%;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 10px;

    border-radius: 10px;

    background: #f9fafb;
}


/* =========================================================
   AVATAR
========================================================= */

.avatar {

    width: 40px;
    height: 40px;

    min-width: 40px;

    background: #14b8a6;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    font-size: 18px;
}


/* =========================================================
   USER INFO
========================================================= */

.info {

    flex: 1;

    min-width: 0;

    margin-left: 10px;
}


.info h4 {

    margin: 0;

    font-size: 14px;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}


.info p {

    margin: 2px 0 0;

    font-size: 12px;

    color: gray;
}


/* =========================================================
   USER STATUS
========================================================= */

.status {

    width: 10px;
    height: 10px;

    min-width: 10px;

    border-radius: 50%;
}


.online {
    background: #22c55e;
}


.offline {
    background: #ef4444;
}


/* =========================================================
   ACTIVITY
========================================================= */

.activity {

    width: 100%;

    margin-top: 20px;

    padding: 15px;

    background: white;

    border-radius: 12px;
}


.activity h3 {

    margin-bottom: 15px;
}


.activity ul {

    list-style: none;

    padding: 0;

    margin: 0;
}


.activity li {

    padding: 8px 0;

    border-bottom: 1px solid #eee;

    font-size: 14px;
}


/* =========================================================
   NOTIFICATIONS
========================================================= */

.notification-dropdown {

    width: 350px;

    max-width: calc(100vw - 20px);

    max-height: 450px;

    overflow-y: auto;

    overflow-x: hidden;
}


.notification-dropdown::-webkit-scrollbar {

    width: 6px;
}


.notification-dropdown::-webkit-scrollbar-thumb {

    background: #bbb;

    border-radius: 10px;
}


/* =========================================================
   SIDEBAR OVERLAY
========================================================= */

.sidebar-overlay {

    display: none;

    position: fixed;

    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    background: rgba(0,0,0,0.45);

    z-index: 1900;
}


/* =========================================================
   SIDEBAR CLOSED - DESKTOP
========================================================= */

body.sidebar-closed .sidebar {

    left: -240px;
}


body.sidebar-closed .navbar {

    left: 0;

    width: 100%;
}


body.sidebar-closed .main {

    margin-left: 0;

    width: 100%;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 1000px) {

    /* Sidebar hidden */

    .sidebar {

        left: -240px;
    }


    /* Navbar full width */

    .navbar {

        left: 0;

        width: 100%;
    }


    /* Main full width */

    .main {

        margin-left: 0;

        width: 100%;

        padding-top: 75px;

        padding-left: 15px;

        padding-right: 15px;
    }


    /* Open sidebar */

    body.sidebar-open .sidebar {

        left: 0;
    }


    body.sidebar-open .sidebar-overlay {

        display: block;
    }


    /* When sidebar opens, main stays full width
       because it is an overlay on tablet */

    body.sidebar-open .main {

        margin-left: 0;

        width: 100%;
    }


    /* Cards */

    .cards {

        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }


    /* Charts */

    .charts {

        grid-template-columns: 1fr;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    /* Navbar */

    .navbar {

        height: 58px;

        padding-left: 8px;

        padding-right: 8px;
    }


    /* Navbar title */

    .navbar-title {

        font-size: 19px;

        max-width: 220px;
    }


    /* Toggle */

    .sidebar-toggle {

        width: 36px;

        height: 36px;

        font-size: 21px;
    }


    /* Main
       FIX: hii hapo awali ilikuwa "position: absolute; left: 170px;
       width: calc(100% - 170px);" ambayo ilikuwa bug -- ilikuwa
       inasukuma content kulia na kuacha nafasi tupu upande wa
       kushoto kwa sababu sidebar imefichwa (left:-240px) kwenye
       simu. Sasa inafanana na tabia ya tablet: full width,
       hakuna absolute positioning. */

    .main {

        margin-left: 0;

        width: 100%;

        padding-top: 70px;

        padding-left: 12px;

        padding-right: 12px;
    }


    /* Cards one per row */

    .cards {

        grid-template-columns: 1fr !important;

        gap: 10px;
    }


    /* Card */

    .card {

        min-height: 100px;

        padding: 12px;
    }


    .card h3 {

        font-size: 17px;
    }


    .card p {

        font-size: 12px;
    }


    .card .icon {

        font-size: 30px;

        right: 12px;

        top: 12px;
    }


    /* Charts */

    .charts {

        grid-template-columns: 1fr !important;

        gap: 10px;

        margin-top: 15px;
    }


    .chart-box {

        padding: 12px;
    }


    .chart-box h3 {

        font-size: 18px;

        line-height: 1.3;
    }


    .chart-container {

        height: 250px;
    }


    /* Current users */

    .user-card {

        padding: 8px;
    }


    .info h4 {

        font-size: 13px;
    }


    .info p {

        font-size: 11px;
    }


    /* Notification */

    .notification-dropdown {

        width: calc(100vw - 20px);

        max-width: calc(100vw - 20px);

        right: -5px !important;
    }

}


/* =========================================================
   VERY SMALL PHONES
========================================================= */

@media (max-width: 380px) {

    .navbar-title {

        font-size: 17px;

        max-width: 180px;
    }


    .main {

        padding-left: 8px !important;

        padding-right: 8px !important;
    }


    .card {

        padding: 10px;
    }


    .card .icon {

        font-size: 27px;
    }


    .chart-box h3 {

        font-size: 17px;
    }


    .chart-container {

        height: 220px;
    }

}


/* =========================================================
   RESPONSIVE IMAGES / MEDIA
========================================================= */

img,
canvas,
video,
iframe {

    max-width: 100%;
}


/* =========================================================
   RESPONSIVE TABLE
========================================================= */

.table-responsive {

    width: 100%;

    overflow-x: auto;
}


/* =========================================================
   FORM ELEMENTS
========================================================= */

input,
select,
textarea,
button {

    max-width: 100%;
}


/* =========================================================
   PREVENT HORIZONTAL SCROLL
========================================================= */

body,
html {

    overflow-x: hidden;
}


/* =========================================================
   SMOOTH SIDEBAR BEHAVIOUR
========================================================= */

.sidebar,
.navbar,
.main {

    transition-duration: 0.3s;

    transition-timing-function: ease;
}

</style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar" id="sidebar">


    @if(Auth::user()->role == "admin")

        <h4 class="text-center mb-3 fw-bold">
            ADMIN PANEL
        </h4>

    @elseif(Auth::user()->role == "landload")

        <h4 class="text-center mb-3 fw-bold">
            LANDLORD PANEL
        </h4>

    @elseif(Auth::user()->role == "customer")

        <h4 class="text-center mb-3 fw-bold">
            TENANT PANEL
        </h4>

    @endif


    <hr class="bg-secondary">


    <ul class="nav flex-column">


        <!-- ================= ADMIN ================= -->

        @if(Auth::user()->role == "admin")


            <li class="nav-item mb-2">

                <a href="{{ route('dashboard') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-home"></i>

                    Dashboard

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('reguser.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-users"></i>

                    User Info

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('buildings.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-building"></i>

                    Buildings

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('bookings.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-calendar-check"></i>

                    Bookings

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('payments.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-money-bill"></i>

                    Payments

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('report.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-chart-line"></i>

                    Report

                </a>

            </li>


        <!-- ================= LANDLORD ================= -->

        @elseif(Auth::user()->role == "landload")


            <li class="nav-item mb-2">

                <a href="{{ route('dashboard') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-home"></i>

                    Dashboard

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('buildings.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-building"></i>

                    Buildings

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('rooms.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-door-open"></i>

                    Rooms

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('reguser.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-users"></i>

                    Tenants

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('bookings.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-calendar-check"></i>

                    Bookings

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('payments.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-money-bill"></i>

                    Payments

                </a>

            </li>


        <!-- ================= CUSTOMER ================= -->

        @elseif(Auth::user()->role == "customer")


            <li class="nav-item mb-2">

                <a href="{{ route('dashboard') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-home"></i>

                    Dashboard

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('bookings.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-calendar-check"></i>

                    Bookings

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('payments.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-money-bill"></i>

                    Payments

                </a>

            </li>


            <li class="nav-item mb-2">

                <a href="{{ route('tenant') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link">

                    <i class="fa fa-user"></i>

                    Details

                </a>

            </li>


        @endif


        <!-- SETTINGS -->

        <li class="nav-item mt-3">

            <a href="{{ route('settings.index') }}"
               class="nav-link d-flex align-items-center gap-2 sidebar-link">

                <i class="fa fa-cog"></i>

                Settings

            </a>

        </li>


        <!-- LOGOUT -->

        <li class="nav-item mt-4">

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="nav-link d-flex align-items-center gap-2 sidebar-link border-0 bg-transparent w-100 text-start">

                    <i class="fa fa-sign-out-alt"></i>

                    Logout

                </button>

            </form>

        </li>


    </ul>

</div>



<!-- =====================================================
     OVERLAY
===================================================== -->

<div class="sidebar-overlay"
     id="sidebarOverlay">
</div>



<!-- =====================================================
     NAVBAR
===================================================== -->

<div class="navbar">


    <div class="navbar-left">


        <!-- SIDEBAR TOGGLE -->

        <button type="button"
                class="sidebar-toggle"
                id="sidebarToggle">

            <i class="fas fa-bars"></i>

        </button>


        <h3 class="navbar-title">
            Dashboard
        </h3>


    </div>


    <!-- RIGHT -->

    <div class="d-flex align-items-center gap-3">


        <!-- ================= NOTIFICATION ================= -->

        @if(Auth::user()->role == "landload")

        <div class="dropdown">


            <button class="btn btn-light position-relative"
                    type="button"
                    data-bs-toggle="dropdown">

                <i class="fas fa-bell fs-5"></i>


                @if($noteCount > 0)

                    <span class="position-absolute
                                 top-0
                                 start-100
                                 translate-middle
                                 badge
                                 rounded-pill
                                 bg-danger">

                        {{ $noteCount }}

                    </span>

                @endif

            </button>


            <ul class="dropdown-menu
                       dropdown-menu-end
                       shadow
                       p-0
                       notification-dropdown">


                <li class="dropdown-header
                           bg-primary
                           text-white
                           py-2">

                    <strong>
                        Notifications
                    </strong>

                </li>


                @forelse($notes as $n)


                    <li>

                        <a href="{{ route('bookings.index') }}"
                           class="dropdown-item
                                  py-3
                                  border-bottom">


                            <strong>
                                {{ $n->title }}
                            </strong>


                            <div class="small text-muted">

                                {{ $n->action }}

                            </div>


                            <div class="small text-secondary">

                                <i class="fas fa-clock"></i>

                                {{ $n->created_at->diffForHumans() }}

                            </div>


                        </a>

                    </li>


                @empty


                    <li>

                        <div class="dropdown-item
                                    text-center
                                    text-muted">

                            No notifications found

                        </div>

                    </li>


                @endforelse


                @if($notes->count() > 0)


                    <li>

                        <hr class="dropdown-divider">

                    </li>


                    <li class="text-center p-2">

                        <form action="{{ route('notifications.clear') }}"
                              method="POST">

                            @csrf

                            @method('DELETE')


                            <button type="submit"
                                    class="btn btn-danger btn-sm w-100">

                                <i class="fas fa-trash"></i>

                                Clear All

                            </button>

                        </form>

                    </li>


                @endif


            </ul>

        </div>

        @endif


    </div>

</div>



<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="main">

    @yield('content')

</div>



<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>

document.addEventListener("DOMContentLoaded", function () {


    const toggleButton =
        document.getElementById("sidebarToggle");


    const overlay =
        document.getElementById("sidebarOverlay");


    const body =
        document.body;


    /* ==========================================
       TOGGLE SIDEBAR
    ========================================== */

    toggleButton.addEventListener("click", function () {


        if (window.innerWidth <= 1000) {

            body.classList.toggle("sidebar-open");

        } else {

            body.classList.toggle("sidebar-closed");

        }

    });


    /* ==========================================
       CLOSE USING OVERLAY
    ========================================== */

    overlay.addEventListener("click", function () {

        body.classList.remove("sidebar-open");

    });


    /* ==========================================
       CLOSE AFTER CLICKING MENU ON MOBILE
    ========================================== */

    document
        .querySelectorAll(".sidebar-link")
        .forEach(function(link) {


            link.addEventListener("click", function () {


                if (window.innerWidth <= 1000) {

                    body.classList.remove(
                        "sidebar-open"
                    );

                }

            });

        });


    /* ==========================================
       RESIZE
    ========================================== */

    window.addEventListener("resize", function () {


        if (window.innerWidth > 1000) {

            body.classList.remove(
                "sidebar-open"
            );

        }

    });

});

</script>


</body>

</html>