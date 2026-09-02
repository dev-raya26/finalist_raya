@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@section('content')

    <div class="activity">
        
        {{-- SEHEMU YA 1: PROFAILI YA MPANGAJI --}}
        <div class="">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                             style="width: 100px; height: 100px; background: #eef2f7;">
                            <i class="fa fa-user fa-3x text-secondary"></i>
                        </div>
                    </div>

                    <div class="col-md-10 text-center text-md-start">
                        <h3 class="fw-bold mb-1 text-dark">
                            {{ $booking->customer->firstname ?? '' }}
                            {{ $booking->customer->lastname ?? '' }}
                        </h3>
                        <span class="text-muted small fw-semibold">Tenant Profile</span>
                    </div>

                </div>
            </div>
        </div>

        {{-- SEHEMU YA 2: KADI TATU ZA MUHTASARI (SUMMARY CARDS) --}}
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center h-100 rounded-4 p-2 bg-white">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fa-solid fa-money-bill-wave text-success fa-2x"></i>
                        </div>
                        <h6 class="text-muted small fw-bold text-uppercase">Total Payments</h6>
                        <h3 class="fw-bold text-success m-0">
                            TZS {{ number_format($totalPaid ?? 0) }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center h-100 rounded-4 p-2 bg-white">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fa-solid fa-wallet text-danger fa-2x"></i>
                        </div>
                        <h6 class="text-muted small fw-bold text-uppercase">Remaining Balance</h6>
                        <h3 class="fw-bold text-danger m-0">
                            TZS {{ number_format($booking->amount ?? 0) }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center h-100 rounded-4 p-2 bg-white">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fa-solid fa-calendar-check text-primary fa-2x"></i>
                        </div>
                        <h6 class="text-muted small fw-bold text-uppercase">Months Paid</h6>
                        <h3 class="fw-bold text-primary m-0">
                            {{ $paidMonths ?? 0 }}
                        </h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- SEHEMU YA 3: MAELEZO YA CHUMBA (ROOM INFORMATION) --}}
        

    </div>
    <div class="activity">
        <div class="">
            
            <div class="card-header mb-3">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fa fa-door-open text-primary me-2"></i> Room Information
                </h5>
            </div>

            <div class="">
                <div class="row">

                    {{-- Picha ya Chumba Kushoto --}}
                    <div class="col-md-4 mb-4 mb-md-0">
                        @if($booking->room && $booking->room->image)
                            <img src="{{ asset('images/' . $booking->room->image) }}"
                                 class="img-fluid rounded-3 shadow-sm"
                                 style="height: 220px; width: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center border" style="height: 220px; width: 100%;">
                                <i class="fa fa-image text-muted fa-3x"></i>
                            </div>
                        @endif
                        
                    </div>

                    {{-- Form/Maelezo ya Kulia --}}
                    <div class="col-md-8">
                        <h4 class="fw-bold text-dark mb-4">
                            Room No: {{ $booking->room->room_number ?? 'N/A' }}
                        </h4>

                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label class="text-muted small fw-bold mb-1">Room Type</label>
                                <input type="text" class="form-control bg-light border-0 py-2" value="{{ $booking->room->type ?? 'N/A' }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small fw-bold mb-1">Room Area</label>
                                <input type="text" class="form-control bg-light border-0 py-2" value="{{ $booking->room->room_area ?? 'N/A' }} SQM" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small fw-bold mb-1">Monthly Rent</label>
                                <input type="text" class="form-control bg-light border-0 py-2 text-success fw-bold" value="TZS {{ number_format($booking->room->price ?? 0) }}" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small fw-bold mb-1">Room Status</label>
                                <input type="text" class="form-control bg-light border-0 py-2 text-capitalize fw-semibold" value="{{ $booking->status ?? 'Booked' }}" readonly>
                            </div>
                            {{-- START DATE --}}
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">
                            Start Date
                        </label>

                        <input type="text"
                               class="form-control bg-light border-0 py-2"
                               value="{{ $booking->start_date }}"
                               readonly>
                    </div>

                    {{-- END DATE --}}
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">
                            End Date
                        </label>

                        <input type="text"
                               class="form-control bg-light border-0 py-2"
                               value="{{ $booking->end_date }}"
                               readonly>
                    </div>
                     <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">
                            Control Number
                        </label>

                        <input type="text"
                               class="form-control bg-light border-0 py-2 fw-bold"
                               value="{{ $booking->control_number ?? 'N/A' }}"
                               readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small fw-bold mb-1">
                            Days Remaining
                        </label>

                        @php
$daysLeft = (int) \Carbon\Carbon::parse($booking->end_date)
            ->diffInDays(now(), false);
@endphp

                        <input type="text"
                               class="form-control bg-light border-0 py-2 fw-bold text-warning"
                               value="{{ abs($daysLeft) }} days"
                               readonly>
                    </div>

                            <div class="col-12">
                                <label class="text-muted small fw-bold mb-1">Description</label>
                                <textarea class="form-control bg-light border-0 rows-2" rows="2" readonly>{{ $booking->room->description ?? 'No description available for this room.' }}</textarea>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    

@endsection
