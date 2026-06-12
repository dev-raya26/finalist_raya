@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<div class="main">

    <div class="cards">
        @if(Auth::user()->role=="admin")
        <div class="card" style="height: 150px">
            <h3>{{ $totalLandlords }}</h3>
            <p>Total Landload</p>
            <i class="fa fa-user icon"></i>
        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalHouses }}</h3>
            <p>House Registered</p>
            <i class="fa fa-school icon"></i>
            
        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalCustomers }}</h3>
            <p>Total Ternant</p>
            <i class="fa fa-user icon"></i>

        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalBookings }}</h3>
            <p>Total Booking</p>
            <i class="fa fa-book icon"></i>
        </div>
        @elseif(Auth::user()->role == "landload")
        <div class="card" style="height: 150px">
            <h3>{{ $totalHouses }}</h3>
            <p>House Registered</p>
            <i class="fa fa-school icon"></i>
            
        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalCustomers }}</h3>
            <p>Total Ternant</p>
            <i class="fa fa-user icon"></i>

        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalBookings }}</h3>
            <p>Total Booking</p>
            <i class="fa fa-book icon"></i>
            
        </div>
        <div class="card" style="height: 150px">
            <h3>0 TZS</h3>
            <p>Payment</p>
            <i class="fa fa-school icon"></i>
        </div>
        @else
        <div class="card" style="height: 150px">
            <h3>{{ $totalBookings }}</h3>
            <p>Total Booking</p>
            <i class="fa fa-book icon"></i>

        </div>
        <div class="card" style="height: 150px">
            <h3>0 TZS</h3>
            <p>Payment</p>
            <i class="fa fa-school icon"></i>
        </div>

        @endif
    </div>
    @if(Auth::user()->role!="customer")
    <div class="charts">
        <div class="chart-box">
    <h3>Approved Bookings per Day (Last 7 Days)</h3>
    <canvas id="lineChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('lineChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($dates) !!},
        datasets: [{
            label: 'Bookings',
            data: {!! json_encode($totals) !!},
            borderColor: '#4e73df',
            backgroundColor: 'rgba(78,115,223,0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                stepSize: 1
            }
        }
    }
});
</script>
  @if(Auth::user()->role != "customer")
        <div class="chart-box">
            <h3>Recent Users</h3>

    <div class="user-list">
        @foreach ($last_users as $l)
        <div class="user-card">
            <div class="avatar">
                <i class="fa fa-user"></i>
            </div>
            <div class="info">
                <h4>{{ $l->firstname }} {{ $l->middlename }}</h4>
                <p>{{ $l->role }}</p>
            </div>
            <span class="status online"></span>
        </div>
        @endforeach

        

    </div>
        </div>
        @endif
    </div>

   
@endif

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection