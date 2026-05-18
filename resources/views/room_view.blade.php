@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')

<div class="main">

    <div class="row justify-content-center">

        <div class="col-lg-11">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="row">

                    <!-- LEFT SIDE : IMAGE -->
                    <div class="col-lg-6 p-0">

                        <div class="h-100">

                            <img src="{{ asset('images/'.$room->image) }}"
                                 alt="Room Image"
                                 class="img-fluid w-100 h-100"
                                 style="object-fit: cover; min-height:600px;">

                        </div>

                    </div>

                    <!-- RIGHT SIDE : DETAILS -->
                    <div class="col-lg-6">

                        <div class="p-5 d-flex flex-column justify-content-center h-100">

                            <!-- Title -->
                            <div class="mb-4">

                                <h2 class="fw-bold">
                                    Room {{ $room->room_number }}
                                </h2>

                                <p class="text-muted">
                                    Full room information and details
                                </p>

                            </div>

                            <!-- Room Type -->
                            <div class="border rounded-3 p-3 mb-3">

                                <h6 class="fw-bold mb-2">
                                    Room Type
                                </h6>

                                <p class="text-muted mb-0">
                                    {{ $room->type }}
                                </p>

                            </div>

                            <!-- Price -->
                            <div class="border rounded-3 p-3 mb-3">

                                <h6 class="fw-bold mb-2">
                                    Monthly Price
                                </h6>

                                <h4 class="text-primary fw-bold mb-0">
                                    Tzs {{ number_format($room->price) }}
                                </h4>

                            </div>

                            <!-- Status -->
                            <div class="border rounded-3 p-3 mb-3">

                                <h6 class="fw-bold mb-2">
                                    Room Status
                                </h6>

                                @if($room->status == 'available')

                                    <span class="badge bg-success px-4 py-2">
                                        Available
                                    </span>

                                @elseif($room->status == 'occupied')

                                    <span class="badge bg-danger px-4 py-2">
                                        Occupied
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark px-4 py-2">
                                        Pending
                                    </span>

                                @endif

                            </div>

                            <!-- Room Size -->
                            <div class="border rounded-3 p-3 mb-3">

                                <h6 class="fw-bold mb-2">
                                    Room Size
                                </h6>

                                <p class="text-muted mb-0">
                                    {{ $room->room_area }} m²
                                </p>

                            </div>

                            <!-- Description -->
                            <div class="border rounded-3 p-3 mb-4">

                                <h6 class="fw-bold mb-2">
                                    Room Description
                                </h6>

                                <p class="text-muted mb-0">
                                    {{ $room->description }}
                                </p>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-3">

                                <a href="{{ url()->previous() }}"
                                   class="btn btn-dark rounded-pill px-4">

                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back
                                </a>

                                <a href="#"
                                   class="btn btn-primary rounded-pill px-4">

                                    Book Now
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection