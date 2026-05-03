@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<div class="main">

    <div class="cards">
        <div class="card" style="height: 150px">
            <h3>{{ $totalLandlords }}</h3>
            <p>Total Landload</p>
            <i class="fa fa-user icon"></i>
        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalHouses }}</h3>
            <p>Total House</p>
            <i class="fa fa-chalkboard icon"></i>
        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalCustomers }}</h3>
            <p>Total Ternant</p>
            <i class="fa fa-book icon"></i>
        </div>

        <div class="card" style="height: 150px">
            <h3>{{ $totalBookings }}</h3>
            <p>Total Booking</p>
            <i class="fa fa-school icon"></i>
        </div>
    </div>

    <div class="charts">
        <div class="chart-box">
            <h3>Reading Trends</h3>
            <canvas id="lineChart"></canvas>
        </div>

        <div class="chart-box">
            <h3>Rooms Utilization</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <div class="activity">
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

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection