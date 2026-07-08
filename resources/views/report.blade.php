@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>

@page{
    size:A4 portrait;
    margin:15mm;
}

@media print{

    body{
        background:#fff;
        font-size:12px;
        color:#000;
    }

    .no-print{
        display:none !important;
    }

    .main{
        margin:0;
        padding:0;
    }

    .card{
        border:none !important;
        box-shadow:none !important;
    }

    .table{
        font-size:11px;
    }

    .table th{
        background:#198754 !important;
        color:white !important;
        border:1px solid #000;
    }

    .table td{
        border:1px solid #000;
    }

    .badge{
        border:1px solid #000;
        color:#000 !important;
        background:white !important;
    }

    .print-footer{
        position:fixed;
        bottom:0;
        width:100%;
        text-align:center;
        font-size:11px;
    }

}

</style>

@section('content')

<div class="main">
    <div class="activity">

    <!-- REPORT HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-success m-0">
                <i class="bi bi-file-earmark-bar-graph"></i> Revenue and Payments Report
            </h3>
            <p class="text-muted m-0">
                Period: {{ request('start_date') ? date('d M Y', strtotime(request('start_date'))) : 'N/A' }} 
                to {{ request('end_date') ? date('d M Y', strtotime(request('end_date'))) : 'N/A' }}
            </p>
        </div>
        
        <!-- Action Buttons -->
        <div class="no-print">
            @if(request('start_date') && request('end_date'))
                <button onclick="printReport()" class="btn btn-primary me-2">
    <i class="bi bi-printer"></i> Print Report
</button>
            @endif
            @if(Auth::user()->role == "customer" && $booking)
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
                    <i class="bi bi-plus-lg"></i> Make Payment
                </button>
            @endif
        </div>
    </div>

    <!-- FILTER FORM SECTION -->
    <div class="card shadow-sm mb-4 no-print">
        <div class="card-body bg-light">
            <form action="{{ url()->current() }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" required>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-grow-1">
                        <i class="bi bi-filter"></i> Filter Data
                    </button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- UTARATIBU WA KUANGALIA KAMA USER AMEFILTER (CHECK IF FILTER IS APPLIED) -->
    @if(request('start_date') && request('end_date'))

        <!-- REVENUE CARDS -->
        <div class="row mb-4">
            <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                <div class="card border-0 bg-success text-white shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="fs-1 me-3"><i class="bi bi-cash-coin"></i></div>
                        <div>
                            <h6 class="card-title text-uppercase mb-1 opacity-75 small">Total Revenue (Paid)</h6>
                            <h4 class="fw-bold mb-0">
                                {{ number_format($payments->where('status', 'paid')->sum('amount'), 2) }} TSH
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 bg-warning text-dark shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="fs-1 me-3"><i class="bi bi-hourglass-split"></i></div>
                        <div>
                            <h6 class="card-title text-uppercase mb-1 opacity-75 small">Pending Payments</h6>
                            <h4 class="fw-bold mb-0">
                                {{ number_format($payments->where('status', 'pending')->sum('amount'), 2) }} TSH
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="printReportArea">

    <div class="text-center mb-4">
        

        <h3>HOUSE RENT MANAGEMENT SYSTEM</h3>

        <h5>REVENUE & PAYMENTS REPORT</h5>

        <hr>

        <strong>
            Period:
            {{ request('start_date') }}
            -
            {{ request('end_date') }}
        </strong>
    </div>

    <!-- TABLE YAKO -->

   
        <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle m-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Control Number</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Paid Date</th>
                                <th class="no-print text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                            <tr>
                                <td class="ps-3">{{ $payment->id }}</td>
                                <td class="fw-semibold text-secondary">
                                    {{ $payment->booking->control_number ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $payment->booking->customer->firstname ?? '' }} 
                                    {{ $payment->booking->customer->lastname ?? '' }}
                                </td>
                                <td class="fw-bold text-dark">
                                    {{ number_format($payment->amount, 2) }}
                                </td>
                                <td>
                                    {{ date('F', mktime(0,0,0,$payment->payment_month,1)) }}
                                </td>
                                <td>
                                    {{ $payment->payment_year }}
                                </td>
                                <td>
                                    @if($payment->status == 'paid')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            Paid
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 text-dark">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    {{ $payment->paid_at ? date('d M Y H:i', strtotime($payment->paid_at)) : 'Not Paid' }}
                                </td>
                                <td class="no-print text-center">
                                    @if($payment->status == 'pending')
                                        @if(Auth::user()->role == 'landload')
                                            <form action="{{ route('payments.verify', $payment->id) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Are you sure you want to verify?')" class="btn btn-success btn-sm px-3">
                                                    Verify
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">Awaiting Verification</span>
                                        @endif
                                    @else
                                        <span class="badge bg-light text-success border border-success-subtle px-2 py-1">
                                            <i class="bi bi-check-circle-fill"></i> Verified
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i> No payments found for this period.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
    </div>



       

    @else
        <!-- ALERT TO COMPEL USER TO FILTER FIRST -->
        <div class="card shadow-sm border-0 bg-info-subtle text-info-emphasis p-4 text-center">
            <div class="my-3">
                <i class="bi bi-calendar-range fs-1"></i>
            </div>
            <h5 class="fw-bold">No Data Displayed</h5>
            <p class="m-0 text-secondary">Please select a **Start Date** and **End Date** above and click **Filter Data** to generate the report.</p>
        </div>
    @endif

</div>
</div>

<!-- PAYMENT MODAL -->
@if(Auth::user()->role == "customer" && $booking)
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title fw-bold">Make Payment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Control Number</label>
                            <input type="text" class="form-control bg-light" value="{{ $booking->control_number }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Month To Pay</label>
                            <select name="payment_month" class="form-select" required>
                                <option value="">Select Month</option>
                                @php
                                    $start = \Carbon\Carbon::parse($booking->start_date)->startOfMonth();
                                    $end = \Carbon\Carbon::parse($booking->end_date)->startOfMonth();
                                @endphp
                                @while($start <= $end)
                                    <option value="{{ $start->month }}">
                                        {{ $start->format('F Y') }}
                                    </option>
                                    $start->addMonth();
                                @endwhile
                            </select>
                        </div>

                        <input type="hidden" name="payment_year" value="{{ now()->year }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Monthly Rent</label>
                            <input type="text" class="form-control bg-light" value="{{ number_format($booking->room->price ?? 0) }}" readonly>
                            <input type="hidden" name="amount" value="{{ $booking->room->price ?? 0 }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success px-4">Submit Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
<script>
function printReport(){

    var printContents = document.getElementById("printReportArea").innerHTML;

    var myWindow = window.open('', '', 'width=1000,height=700');

    myWindow.document.write(`
        <html>
        <head>

            <title>Revenue Report</title>

            <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

            <style>

                body{
                    padding:30px;
                    font-family:Arial,sans-serif;
                    font-size:13px;
                }

                table{
                    width:100%;
                    border-collapse:collapse;
                }

                table th,
                table td{
                    border:1px solid #000;
                    padding:8px;
                    text-align:left;
                }

                table th{
                    background:#198754;
                    color:#fff;
                }

                h3,h5{
                    text-align:center;
                }

            </style>

        </head>

        <body>

            ${printContents}

        </body>

        </html>
    `);

    myWindow.document.close();

    myWindow.focus();

    myWindow.print();

    myWindow.close();

}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}'
    });
</script>
@endif

@endsection