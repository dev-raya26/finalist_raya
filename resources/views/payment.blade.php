@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

@section('content')



    <div class="activity">
        

        <div class="card-body">
         @if(Auth::user()->role =="customer")
            <button class="btn btn-success mb-3"
                    data-bs-toggle="modal"
                    data-bs-target="#paymentModal">
                <i class="fa fa-plus"></i>
                Make Payment
            </button>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Paid Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($payments as $payment)

                        <tr>

                            <td>{{ $payment->id }}</td>

                            <td>
                                {{ $payment->booking->customer->firstname }}
                                {{ $payment->booking->customer->lastname }}
                            </td>

                            <td>
                                {{ number_format($payment->amount,2) }}
                            </td>

                            <td>
                                {{ date('F', mktime(0,0,0,$payment->payment_month,1)) }}
                            </td>

                            <td>
                                {{ $payment->payment_year }}
                            </td>

                            <td>
                                @if($payment->status == 'paid')
                                    <span class="badge bg-success">
                                        Paid
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $payment->paid_at ?? 'Not Paid' }}
                            </td>
                            <td>
    @if($payment->status == 'pending')

        @if(Auth::user()->role == 'landload')

            <form action="{{ route('payments.verify',$payment->id) }}"
                  method="POST">

                @csrf

                <button type="submit"
                        onclick="return confirm('Are you sure you want to verify?')"
                        class="btn btn-success btn-sm">
                    Verify
                </button>

            </form>

        @endif

    @else

        <span class="badge bg-success">
            Verified
        </span>

    @endif
</td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="text-center">
                                No payments found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>


<!-- PAYMENT MODAL -->
@if(Auth::user()->role == "customer")

    @if($booking)

    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            Make Payment
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden"
                               name="booking_id"
                               value="{{ $booking->id }}">

                        <!-- Control Number -->
                        <div class="mb-3">
                            <label class="form-label">
                                Mobile Number
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $booking->control_number }}"
                                   readonly>
                        </div>

                        <!-- Month -->
                        <div class="mb-3">
                            <label class="form-label">
                                Select Month To Pay
                            </label>

                            <select name="payment_month"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Select Month
                                </option>

                                @php
                                    $start = \Carbon\Carbon::parse($booking->start_date)->startOfMonth();
                                    $end = \Carbon\Carbon::parse($booking->end_date)->startOfMonth();
                                @endphp

                                @while($start <= $end)

                                    <option value="{{ $start->month }}">
                                        {{ $start->format('F Y') }}
                                    </option>

                                    @php
                                        $start->addMonth();
                                    @endphp

                                @endwhile

                            </select>
                        </div>

                        <!-- Year -->
                        <input type="hidden"
                               name="payment_year"
                               value="{{ now()->year }}">

                        <!-- Monthly Rent -->
                        <div class="mb-3">
                            <label class="form-label">
                                Monthly Rent
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ number_format($booking->room->price ?? 0) }}"
                                   readonly>

                            <input type="hidden"
                                   name="amount"
                                   value="{{ $booking->room->price ?? 0 }}">
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit"
                                class="btn btn-success">
                            Submit Payment
                        </button>

                    </div>

                </form>

            </div>
        </div>
    

    @else

    

    @endif

@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@if(session('success'))

<script>
Swal.fire({
    icon:'success',
    title:'Success',
    text:'{{ session("success") }}'
});
</script>

@endif

@endsection