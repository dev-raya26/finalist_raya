<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    overflow: hidden;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 170px;
    height: 100vh;
    background: linear-gradient(180deg, #0f766e, #14b8a6);
    color: white;
    padding: 15px;
}

.sidebar-link {
    padding: 10px;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar-link:hover {
    background: #198754; /* bootstrap green */
    color: #fff;
    padding-left: 15px;
}

.sidebar-link i {
    width: 20px;
    text-align: center;
}

/* NAVBAR */
.navbar {
    position: fixed;
    top: 0;
    left: 170px;
    width: calc(100% - 170px);
    height: 60px;
    background: white;
    display: flex;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    z-index: 1000;
}

/* MAIN */
.main {
    position: absolute;
    top: 60px;
    left: 170px;
    width: calc(100% - 170px);
    height: calc(100vh - 60px);
    padding: 20px;
    overflow-y: auto;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px,1fr));
    gap: 12px;
}

.card {
    background: white;
    padding: 10px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    height: 80px; 
    position: relative;
}

.card h3 {
    font-size: 18px;
}

.card p {
    font-size: 13px;
    color: #555;
}

.card .icon {
    position: absolute;
    right: 15px;
    top: 15px;
    font-size: 38px; 
    color: #14b8a6;
    opacity: 0.9;
}

/* CHARTS */
.charts {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 15px;
    margin-top: 20px;
}

.chart-box {
    background: white;
    padding: 15px;
    border-radius: 12px;
}

/* ACTIVITY */
.activity {
    margin-top: 20px;
    background: white;
    padding: 15px;
    border-radius: 12px;
}

.activity ul {
    list-style: none;
}

.activity li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

/* RESPONSIVE */
@media(max-width: 900px){
    .charts {
        grid-template-columns: 1fr;
    }
}
.activity {
    margin-top: 20px;
    background: white;
    padding: 15px;
    border-radius: 12px;
}

.activity h3 {
    margin-bottom: 15px;
}

/* USER LIST */
.user-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* USER CARD */
.user-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    border-radius: 10px;
    background: #f9fafb;
    transition: 0.3s;
}

.user-card:hover {
    background: #eefaf8;
}

/* AVATAR */
.avatar {
    width: 40px;
    height: 40px;
    background: #14b8a6;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 18px;
}

/* INFO */
.info {
    flex: 1;
    margin-left: 10px;
}

.info h4 {
    margin: 0;
    font-size: 14px;
}

.info p {
    margin: 2px 0 0;
    font-size: 12px;
    color: gray;
}

/* STATUS DOT */
.status {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.online {
    background: #22c55e;
}

.offline {
    background: #ef4444;
}
li a{
    color: white;
    text-decoration: none;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar bg-dark text-white vh-100 p-3">
        @if(Auth::user()->role=="admin")
    <h4 class="text-center mb-3 fw-bold" style="font-size: 20px">ADMIN PANEL</h4>
        @elseif(Auth::user()->role=="landload")
    <h4 class="text-center mb-3 fw-bold" style="font-size: 20px">LANDLORD PANEL</h4>
    @elseif(Auth::user()->role=="customer")
    <h4 class="text-center mb-3 fw-bold" style="font-size: 20px">CUSTOMER PANEL</h4>


      @endif
    <hr class="bg-secondary">

    <ul class="nav flex-column">
     @if(Auth::user()->role =="admin")
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-home"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('reguser.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-users"></i>
                User Info
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('buildings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-building"></i>
                Buildings
            </a>
        </li>

        {{-- <li class="nav-item mb-2">
            <a href="{{ route('rooms.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-door-open"></i>
                Rooms
            </a>
        </li> --}}

        <li class="nav-item mb-2">
            <a href="{{ route('bookings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-calendar-check"></i>
                Bookings
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('bookings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-calendar-check"></i>
                Payment
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('bookings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-calendar-check"></i>
                Report
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="#" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-cog"></i>
                Settings
            </a>
        </li>
        @elseif (Auth::user()->role=="landload")
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-home"></i>
                Dashboard
            </a>
        </li>
         <li class="nav-item mb-2">
            <a href="{{ route('buildings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-building"></i>
                Buildings
            </a>
        </li>
        {{-- <li class="nav-item mb-2">
            <a href="{{ route('rooms.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-door-open"></i>
                Rooms
            </a>
        </li> --}}
        <li class="nav-item mb-2">
            <a href="{{ route('reguser.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-users"></i>
                Ternants 
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('bookings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-calendar-check"></i>
                Bookings
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-cog"></i>
                Settings
            </a>
        </li>
        @elseif (Auth::user()->role=="customer")
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-home"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('bookings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-calendar-check"></i>
                Bookings
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('bookings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-calendar-check"></i>
                Payments
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('bookings.index') }}" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link">
                <i class="fa fa-calendar-check"></i>
                Location
            </a>
        </li>


        @endif
        <li class="nav-item mb-2">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link text-white d-flex align-items-center gap-2 sidebar-link border-0 bg-transparent w-100 text-start">
            <i class="fa fa-sign-out-alt"></i>
            Logout
        </button>
    </form>
</li>

    </ul>
</div>

<!-- NAVBAR -->
<div class="navbar">
    <h3>Dashboard</h3>
</div>

<!-- MAIN -->
  @yield('content')

<script>
new Chart(document.getElementById("lineChart"), {
    type: 'line',
    data: {
        labels: ["Mon","Tue","Wed","Thu","Fri"],
        datasets: [{
            label: "Students",
            data: [5, 10, 7, 14, 8],
            borderWidth: 3,
            tension: 0.4
        }]
    }
});

new Chart(document.getElementById("pieChart"), {
    type: 'doughnut',
    data: {
        labels: ["Active", "Busy", "Free"],
        datasets: [{
            data: [60, 25, 15]
        }]
    }
});
</script>

</body>
</html>