@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="main">

    <div class="activity">
        <h3>Booking Management</h3>

        <!-- ADD BUTTON -->
        @if(Auth::user()->role=="customer")
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            + Add Booking
        </button>
        @endif

        <div class="user-list">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <td>House</td>
                        <th>Room</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Remain Days</th>
                        <th>Status</th>
            @if(Auth::user()->role=="landload")
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>
    @if($booking->customer)
        {{ $booking->customer->firstname }} 
        {{ $booking->customer->middlename }} 
        {{ $booking->customer->lastname }}
    @else
        <span style="color:red;">No Customer</span>
    @endif
</td>
                            <td>{{ $booking->room->building->room_name }}</td>

                            <td>{{ $booking->room->room_number}}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>
    @php
        $today = \Carbon\Carbon::now();
        $end = \Carbon\Carbon::parse($booking->end_date);

        $remainDays = (int) $today->diffInDays($end, false);
    @endphp

    @if($remainDays > 0)
        <span class="badge bg-info">{{ $remainDays }} days left</span>
    @elseif($remainDays == 0)
        <span class="badge bg-warning">Last day</span>
    @else
        <span class="badge bg-danger">Expired ({{ abs($remainDays) }} days ago)</span>
    @endif
</td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($booking->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
            @if(Auth::user()->role=="landload")
                            <td>
                                
       
                                
                                <button class="btn btn-warning btn-sm editBtn"
                                    data-id="{{ $booking->id }}"
                                    data-status="{{ $booking->status }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit & approve
                                </button>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No bookings found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ================= ADD MODAL ================= -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">

        <form action="{{ route('bookings.store') }}" method="POST">
    @csrf

    <div class="modal-header">
        <h5>Add Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">

       
        <!-- ROOM SELECT -->
        <select name="room_id" id="room_id" class="form-control mb-2" required>
    <option value="">Select Room</option>

    @foreach($buildings as $building)
        <optgroup label="{{ $building->name ?? 'Building '.$building->room_name.' '.$building->location}}">

            @foreach($building->rooms as $room)
                <option value="{{ $room->id }}" data-price="{{ $room->price }}">
                    Room {{ $room->room_number }} - {{ $room->price }}/month
                </option>
            @endforeach

        </optgroup>
    @endforeach

</select>

        <input type="date" name="start_date" id="start_date" class="form-control mb-2" required>

        <input type="date" name="end_date" id="end_date" class="form-control mb-2" required>

        <!-- AUTO AMOUNT -->
        <input type="text" name="amount" id="amount" class="form-control mb-2" placeholder="Total Amount" readonly>

       

    </div>

    <div class="modal-footer">
        <button class="btn btn-success">Save</button>
    </div>

</form>

        </div>
    </div>
</div>

<!-- ================= EDIT MODAL ================= -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Approve booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

    
                    <select id="status" name="status" class="form-control mb-2">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                    </select>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Approve</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script>
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('editForm').action = "/bookings/" + id;

        document.getElementById('customer_id').value = this.dataset.customer_id;
        document.getElementById('room_id').value = this.dataset.room_id;
        document.getElementById('start_date').value = this.dataset.start_date;
        document.getElementById('end_date').value = this.dataset.end_date;
        document.getElementById('status').value = this.dataset.status;

    });
});
</script>
<script>
function calculateAmount() {

    let room = document.getElementById('room_id');
    let price = room.options[room.selectedIndex]?.dataset.price;

    let start = new Date(document.getElementById('start_date').value);
    let end = new Date(document.getElementById('end_date').value);

    if (!price || !start || !end) return;

    price = parseFloat(price);

    // calculate months
    let months = (end.getFullYear() - start.getFullYear()) * 12;
    months -= start.getMonth();
    months += end.getMonth();

    months = months <= 0 ? 1 : months;

    let total = months * price;

    document.getElementById('amount').value = total;
}

// listeners
document.getElementById('room_id').addEventListener('change', calculateAmount);
document.getElementById('start_date').addEventListener('change', calculateAmount);
document.getElementById('end_date').addEventListener('change', calculateAmount);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session('success') }}',
    confirmButtonText: 'OK'
});
</script>
@endif
@endsection