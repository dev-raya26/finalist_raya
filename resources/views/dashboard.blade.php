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
            <h3>{{ $customerActiveBookingsCount }}</h3>
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
  @if(Auth::user()->role=="admin")
        <div class="chart-box">
            <h3>Current Users</h3>

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

   @else
   <div class="row g-4 mt-2">
            
            <!-- VYUMBA ALIVYO-RENT (MY ACTIVE ROOMS WITH IMAGES) -->
            <div class="col-lg-7">
    <div class="card p-4 shadow-sm border bg-white h-100">
        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
            <h5 class="fw-bold text-dark m-0 fs-4">
                <i class="bi bi-house-door text-primary me-2"></i> My Active Leases & Rooms
            </h5>
            <span class="badge bg-primary text-white rounded-pill px-3 py-2 fw-bold">
                {{ count($myActiveRooms ?? []) }} Active
            </span>
        </div>
        
        <div class="row g-3">
            @forelse($myActiveRooms ?? [] as $myBooking)
                <div class="col-md-12">
                    <div class="card p-3 border shadow-sm bg-white lease-card position-relative overflow-hidden" style="min-height: 210px; border-radius: 12px; transition: transform 0.2s;">
                        <div class="d-flex flex-column flex-md-row align-items-center h-100 w-100">
                            
                            <div class="flex-shrink-0 mb-3 mb-md-0 me-md-4 text-center">
                                @if($myBooking->room && $myBooking->room->image)
                                    <img src="{{ asset('images/' . $myBooking->room->image) }}" class="rounded shadow-sm" style="width: 180px; height: 180px; object-fit: cover; display: block; border: 1px solid #ddd;">
                                @else
                                    <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center text-secondary shadow-sm" style="width: 180px; height: 180px; border: 1px solid #eee;">
                                        <i class="bi bi-door-closed fs-1 text-muted mb-2"></i>
                                        <span class="small fw-semibold text-muted">No Image Available</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-grow-1 text-center text-md-start w-100 mt-2 mt-md-0">
                                <h4 class="fw-bold text-dark mb-2 text-truncate" style="max-width: 280px;">
                                    {{ $myBooking->room->building->room_name ?? 'Apartment Name' }}
                                </h4>
                                
                                <p class="text-muted mb-1 fs-6">
                                    <i class="bi bi-hash text-secondary"></i> Room Number: <strong class="text-dark">{{ $myBooking->room->room_number ?? 'N/A' }}</strong>
                                </p>
                                
                                <h5 class="text-success fw-bold mb-3 fs-5">
                                    <i class="bi bi-cash-stack"></i> Remaining Rent <Br> {{ number_format($myBooking->amount) }} TZS
                                </h5>
                                
                                <div class="text-muted small p-2 bg-light rounded-2 d-inline-block border-start border-danger border-3" style="font-size: 0.85rem;">
                                    <i class="bi bi-calendar3 text-danger me-1"></i> Contract Ends: 
                                    <strong class="text-dark">{{ \Carbon\Carbon::parse($myBooking->end_date)->format('d M, Y') }}</strong>
                                </div>
                            </div>
                            
                            <div class="text-center text-md-end mt-3 mt-md-0 ms-md-auto flex-shrink-0">
                                @php
                                    $daysLeft = (int) \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($myBooking->end_date), false);
                                @endphp
                                @if($daysLeft > 0)
                                    <span class="badge bg-success text-white px-3 py-2 rounded-pill fs-6 fw-semibold shadow-sm">
                                        <i class="bi bi-hourglass-split me-1"></i> {{ $daysLeft }} days left
                                    </span>
                                @elseif($daysLeft == 0)
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fs-6 fw-semibold shadow-sm">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Ends Today
                                    </span>
                                @else
                                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fs-6 fw-semibold shadow-sm">
                                        <i class="bi bi-x-circle-fill me-1"></i> Expired
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-house-x text-muted mb-3" style="font-size: 3rem;"></i>
                    <p class="text-muted small">You don't have any active room bookings at the moment.</p>
                    <a href="/bookings" class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-search"></i> Browse Rooms</a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    /* Athari ndogo ya kuinuka kadi mteja akigusa */
    .lease-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.08) !important;
    }
</style>

            <!-- HISTORIA YA MWAMALA / TRANSACTIONS -->
            <div class="col-lg-5">
                <div class="card p-4 shadow-sm border bg-white h-100">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-receipt text-secondary"></i> Recent Payment Statements</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle small m-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ref ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($myPayments ?? [] as $payment)
                                    <tr>
                                        <td><strong>#{{ $payment->reference_no ?? $payment->id }}</strong></td>
                                        <td class="fw-bold text-dark">TZS {{ number_format($payment->amount) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M, Y') }}</td>
                                        <td><span class="badge bg-light text-success border border-success px-2 py-1">Paid</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4 small">No transaction records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>



@endif

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection