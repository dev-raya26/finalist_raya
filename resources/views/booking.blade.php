@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .selected-room .card{
    border:3px solid #0d6efd !important;
    box-shadow:0 0 15px rgba(13,110,253,.4);
}
</style>
@section('content')

    @if(Auth::user()->role == "customer")
<div class="activity">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h3 class="text-primary fw-bold m-0">
            <i class="bi bi-house-heart-fill"></i> House Booking Portal
        </h3>
        <div>
            <button class="btn btn-outline-secondary btn-sm me-2" type="button" data-bs-toggle="collapse" data-bs-target="#bookingsTableCollapse">
                <i class="bi bi-list-task"></i> View Booking History / Approvals
            </button>
        </div>
    </div>

   <div class="collapse mb-5" id="bookingsTableCollapse">
    <div class="w-100 pt-3">
        <div class="d-flex align-items-center mb-3">
            <h5 class="fw-bold text-dark m-0">
                <i class="bi bi-clock-history text-primary"></i> Booking Records & Management
            </h5>
        </div>
        
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-bordered table-hover align-middle bg-white m-0" style="width: 100%; min-width: 900px;">
                <thead class="table-dark text-uppercase fs-7">
                    <tr>
                        <th class="py-3 px-3" style="width: 20%;">Customer Details</th>
                        <th class="py-3 px-3">House Name</th>
                        <th class="py-3 px-2 text-center">Room No</th>
                        <th class="py-3 px-3">Start Date</th>
                        <th class="py-3 px-3">End Date</th>
                        <th class="py-3 px-3 text-center">Remaining Days</th>
                        <th class="py-3 px-3 text-center">Status</th>
                        @if(Auth::user()->role == "landload")
                            <th class="py-3 px-3 text-center" style="width: 15%;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td class="py-3 px-3">
                                @if($booking->customer)
                                    <div class="fw-bold text-secondary">{{ $booking->customer->firstname }} {{ $booking->customer->lastname }}</div>
                                    <small class="text-muted d-block mt-1"><i class="bi bi-telephone"></i> {{ $booking->customer->phone }}</small>
                                @else
                                    <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle"></i> No Customer</span>
                                @endif
                            </td>
                            <td class="py-3 px-3">
                                <span class="fw-semibold text-primary">{{ $booking->room->building->room_name ?? 'N/A' }}</span>
                            </td>
                            <td class="py-3 px-2 text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 fw-bold fs-6">{{ $booking->room->room_number ?? 'N/A' }}</span>
                            </td>
                            <td class="py-3 px-3 text-secondary">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M, Y') }}</td>
                            <td class="py-3 px-3 text-secondary">{{ \Carbon\Carbon::parse($booking->end_date)->format('d M, Y') }}</td>
                            <td class="py-3 px-3 text-center">
                                @php
                                    $today = \Carbon\Carbon::now();
                                    $end = \Carbon\Carbon::parse($booking->end_date);
                                    $remainDays = (int) $today->diffInDays($end, false);
                                @endphp

                                @if($remainDays > 0)
                                    <span class="badge bg-info text-dark d-inline-block px-3 py-2 fw-semibold rounded-pill">
                                        <i class="bi bi-hourglass-split"></i> {{ $remainDays }} days left
                                    </span>
                                @elseif($remainDays == 0)
                                    <span class="badge bg-warning text-dark d-inline-block px-3 py-2 fw-semibold rounded-pill">
                                        <i class="bi bi-exclamation-circle"></i> Last day today
                                    </span>
                                @else
                                    <span class="badge bg-danger text-white d-inline-block px-3 py-2 fw-semibold rounded-pill">
                                        <i class="bi bi-x-circle"></i> Expired ({{ abs($remainDays) }} days ago)
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-center">
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-pause-circle"></i> Pending</span>
                                @elseif($booking->status == 'approved')
                                    <span class="badge bg-success text-white px-3 py-2 rounded-pill"><i class="bi bi-check-circle"></i> Approved</span>
                                @else
                                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill"><i class="bi bi-slash-circle"></i> Rejected</span>
                                @endif
                            </td>
                            @if(Auth::user()->role == "landload")
                                <td class="py-3 px-3 text-center">
                                    <button class="btn btn-warning btn-sm editBtn fw-bold px-3 shadow-sm"
                                        data-id="{{ $booking->id }}"
                                        data-status="{{ $booking->status }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="bi bi-pencil-square"></i> Action
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5 fs-5">
                                <i class="bi bi-folder-x d-block fs-2 mb-2 text-secondary"></i> No booking records available in the system.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div id="section-buildings">
        <h4 class="fw-bold mb-4 text-secondary"><i class="bi bi-building"></i> Explore Our Houses & Apartments</h4>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($buildings as $building)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 building-card hvr-float" style="cursor: pointer;" 
                         onclick="showRooms('{{ $building->id }}', '{{ $building->room_name }}')">
                        
                        <div class="position-relative">
                            @if($building->image)
                                <img src="{{ asset('images/' . $building->image) }}" class="card-img-top rounded-top" alt="{{ $building->room_name }}" style="height: 240px; object-fit: cover;">
                            @else
                                <div class="bg-secondary text-white d-flex flex-column align-items-center justify-content-center rounded-top" style="height: 240px;">
                                    <i class="bi bi-houses" style="font-size: 4rem;"></i>
                                    <span class="small">No Image Uploaded</span>
                                </div>
                            @endif
                            <span class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 m-2 rounded-pill small fw-bold">
                                {{ $building->rooms->count() }} Rooms Available
                            </span>
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $building->room_name }}</h5>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt text-danger"></i> {{ $building->location ?? 'Location N/A' }}</p>
                            <p class="card-text text-secondary text-truncate-3 flex-grow-1">
                                {{ $building->description ?? 'No specific description provided for this building.' }}
                            </p>
                            <div class="mt-3 border-top pt-2 text-primary fw-bold text-end small">
                                Click to view rooms <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-emoji-frown text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-2">No active buildings with available rooms found at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>


    <div id="section-rooms" class="d-none animate-fade-in">
        <div class="d-flex align-items-center mb-4">
            <button class="btn btn-light border btn-sm me-3" onclick="backToBuildings()">
                <i class="bi bi-arrow-left"></i> Back to Houses
            </button>
            <h4 class="fw-bold m-0 text-secondary">
                Available Rooms in <span id="dynamic-building-title" class="text-primary"></span>
            </h4>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" id="rooms-wrapper">
            @foreach($buildings as $b)
                @foreach($b->rooms as $room)
                    <div class="col room-item-card d-none
@if(isset($selectedRoom) && $selectedRoom && $selectedRoom->id == $room->id)
selected-room
@endif"
data-building-id="{{ $b->id }}">
                        <div class="card h-100 border-0 shadow-sm">
                            
                            @if($room->image)
                                <img src="{{ asset('images/' . $room->image) }}" class="card-img-top" alt="Room {{ $room->room_number }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-dark text-white d-flex flex-column align-items-center justify-content-center" style="height: 200px;">
                                    <i class="bi bi-door-closed" style="font-size: 3.5rem;"></i>
                                    <span class="small opacity-50">No Room Image</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-bold m-0 text-dark">Room No: {{ $room->room_number }}</h5>
                                    <span class="badge bg-success fs-6">TZS {{ number_format($room->price) }} / Month</span>
                                </div>

                                <div class="p-2 bg-light rounded mb-3 small">
                                    <div class="row mb-1">
                                        <div class="col-5 text-muted">Room Type:</div>
                                        <div class="col-7 fw-bold text-secondary">{{ $room->type ?? 'Standard' }}</div>
                                    </div>
                                    @if($room->room_area)
                                    <div class="row mb-1">
                                        <div class="col-5 text-muted">Square Area:</div>
                                        <div class="col-7 fw-bold text-secondary">{{ $room->room_area }} SQM</div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-5 text-muted">Status:</div>
                                        <div class="col-7"><span class="badge bg-light text-success border border-success">Available</span></div>
                                    </div>
                                </div>

                                <p class="card-text text-muted small mb-4 text-truncate-3">
                                    <strong>Description:</strong> {{ $room->description ?? 'No extra details mentioned.' }}
                                </p>

                                @if(Auth::user()->role == "customer")
                                    <button class="btn btn-primary w-100 fw-bold py-2" 
                                            onclick="openBookingForm('{{ $room->id }}', '{{ $room->room_number }}', '{{ $room->price }}', '{{ $b->room_name }}')">
                                        <i class="bi bi-bookmark-plus"></i> Book Now
                                    </button>
                                @else
                                    <button class="btn btn-secondary w-100 small disabled" disabled>Log in as Customer to Book</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

</div>
@else
<div class="activity">
        <h3>Booking Management</h3>

        

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
                        <th>Action</th>
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
                            <td>
                                
       
                                
                                <button class="btn btn-primary btn-sm editBtn"
                                    data-id="{{ $booking->id }}"
                                    data-status="{{ $booking->status }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Approve
                                </button>
                            </td>
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


@endif


<div class="modal fade" id="wizardFormModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-text"></i> Complete Your Booking</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('bookings.store') }}" method="POST" id="wizardSubmissionForm">
                @csrf
                <input type="hidden" name="room_id" id="hidden_room_id">

                <div class="modal-body">
                    <div class="alert alert-info py-2 small mb-3">
                        <div class="mb-1"><strong>Selected House:</strong> <span id="modal-summary-house"></span></div>
                        <div class="mb-1"><strong>Room Number:</strong> <span id="modal-summary-room"></span></div>
                        <div><strong>Monthly Rent:</strong> TZS <span id="modal-summary-price"></span></div>
                    </div>

                   <div class="mb-3">
    <label class="form-label small fw-bold">Select Start Date</label>
    <input type="date"
           name="start_date"
           id="form_start_date"
           class="form-control"
           min="{{ date('Y-m-d') }}"
           value="{{ date('Y-m-d') }}"
           required>
</div>

<div class="mb-3">
    <label class="form-label small fw-bold">Select End Date</label>
    <input type="date"
           name="end_date"
           id="form_end_date"
           class="form-control"
           min="{{ date('Y-m-d') }}"
           value="{{ date('Y-m-d') }}"
           required>
</div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold text-danger">Total Estimated Amount (TZS)</label>
                        <input type="text" name="amount" id="form_total_amount" class="form-control fw-bold text-danger bg-light fs-5 text-center" readonly placeholder="0.00">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success px-4 fw-bold"><i class="bi bi-send-check"></i> Submit Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-dark fw-bold">
                    <h5 class="modal-title fw-bold"><i class="bi bi-shield-check"></i> Landlord Action Center</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-bold small">Update Booking Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success btn-sm">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    .building-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .building-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important; }
    .text-truncate-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
</style>
<script>
    document.getElementById('form_start_date').addEventListener('change', function () {
    document.getElementById('form_end_date').min = this.value;

    if (document.getElementById('form_end_date').value < this.value) {
        document.getElementById('form_end_date').value = this.value;
    }
});
</script>
@if(isset($selectedRoom) && $selectedRoom)

<script>
document.addEventListener('DOMContentLoaded', function () {

    showRooms(
        "{{ $selectedRoom->building_id }}",
        "{{ $selectedRoom->building->room_name }}"
    );

});
</script>

@endif
<script>
const sectionBuildings = document.getElementById('section-buildings');
const sectionRooms = document.getElementById('section-rooms');
const dynamicTitle = document.getElementById('dynamic-building-title');

function showRooms(buildingId, buildingName) {
    dynamicTitle.innerText = buildingName;

    document.querySelectorAll('.room-item-card').forEach(card => {
        if (card.dataset.buildingId === buildingId) {
            card.classList.remove('d-none');
        } else {
            card.classList.add('d-none');
        }
    });

    sectionBuildings.classList.add('d-none');
    sectionRooms.classList.remove('d-none');
}

function backToBuildings() {
    sectionRooms.classList.add('d-none');
    sectionBuildings.classList.remove('d-none');
}

function openBookingForm(roomId, roomNumber, price, buildingName) {
    document.getElementById('hidden_room_id').value = roomId;
    document.getElementById('modal-summary-house').innerText = buildingName;
    document.getElementById('modal-summary-room').innerText = roomNumber;
    document.getElementById('modal-summary-price').innerText = parseFloat(price).toLocaleString();

    document.getElementById('wizardSubmissionForm').dataset.activePrice = price;

    const today = new Date().toISOString().split('T')[0];
    
document.getElementById('form_start_date').value = today;
document.getElementById('form_end_date').value = today;

document.getElementById('form_start_date').min = today;
document.getElementById('form_end_date').min = today;

document.getElementById('form_total_amount').value = '';

    
    var bookingModal = new bootstrap.Modal(document.getElementById('wizardFormModal'));
    bookingModal.show();
}


function calculateRentAmount() {
    const form = document.getElementById('wizardSubmissionForm');
    let price = form.dataset.activePrice;
    
    let startVal = document.getElementById('form_start_date').value;
    let endVal = document.getElementById('form_end_date').value;

    if (!price || !startVal || !endVal) return;

    let start = new Date(startVal);
    let end = new Date(endVal);
    price = parseFloat(price);

    let months = (end.getFullYear() - start.getFullYear()) * 12;
    months -= start.getMonth();
    months += end.getMonth();

   
    months = months <= 0 ? 1 : months;
    let total = months * price;

    document.getElementById('form_total_amount').value = total.toFixed(2);
}

document.getElementById('form_start_date').addEventListener('change', calculateRentAmount);
document.getElementById('form_end_date').addEventListener('change', calculateRentAmount);


document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function () {
        let id = this.dataset.id;
        document.getElementById('editForm').action = "/bookings/" + id;
        document.getElementById('status').value = this.dataset.status;
    });
});
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