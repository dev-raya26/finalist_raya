@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')


<div class="activity">

                <div class="row">

                    <!-- LEFT SIDE -->
                    <div class="col-lg-4">

                        <img src="{{ asset('images/'.$building->image) }}"
                            class="img-fluid rounded-4 shadow-sm w-100"
                            style="height:350px; object-fit:cover;">

                        <div class="card border-0 bg-light mt-3 rounded-4">
                            <div class="card-body text-center">

                                <div class="mb-2">
                                    <i class="fas fa-user-circle fa-3x text-primary"></i>
                                </div>

                                <h5 class="fw-bold mb-1">
                                    {{ $building->landlord->firstname }} {{ $building->landlord->middlename }} {{ $building->landlord->lastname }}
                                </h5>

                                <small class="text-muted">
                                    Property Owner
                                </small>

                            </div>
                        </div>

                    </div>

                    <!-- RIGHT SIDE -->
                    <div class="col-lg-8">

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>
                                <h2 class="fw-bold mb-1 text-success">
                                   House Name: {{ $building->room_name }}
                                </h2>

                                <small class="text-muted">
                                    Building Information
                                </small>
                            </div>

                            <span class="badge bg-success fs-6 px-3 py-2">
                                {{ $building->status }}
                            </span>

                        </div>

                        <!-- INFO CARDS -->
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="card border-0 bg-light h-100 rounded-4">
                                    <div class="card-body">

                                        <small class="text-muted">
                                            Building Name
                                        </small>

                                        <h5 class="fw-bold mt-2">
                                            <i class="fas fa-building text-primary me-2"></i>
                                            {{ $building->room_name }}
                                        </h5>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 bg-light h-100 rounded-4">
                                    <div class="card-body">

                                        <small class="text-muted">
                                            Location
                                        </small>

                                        <h5 class="fw-bold mt-2">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            {{ $building->location }}
                                        </h5>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 bg-light h-100 rounded-4">
                                    <div class="card-body">

                                        <small class="text-muted">
                                            Registered Date
                                        </small>

                                        <h5 class="fw-bold mt-2">
                                            <i class="fas fa-calendar-alt text-success me-2"></i>
                                            {{ $building->created_at->format('d M Y') }}
                                        </h5>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 bg-light h-100 rounded-4">
                                    <div class="card-body">

                                        <small class="text-muted">
                                            Status
                                        </small>

                                        <h5 class="fw-bold mt-2">
                                            <span class="badge bg-success">
                                               {{ $building->status }}
                                            </span>
                                        </h5>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- DESCRIPTION -->
                        <div class="card border-0 bg-light rounded-4 mt-4">
                            <div class="card-body">

                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-align-left text-success me-2"></i>
                                    Description
                                </h5>

                                <p class="text-muted mb-0">
                                    {{ $building->description }}
                                </p>

                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="mt-4">

                            <a href="{{ url()->previous() }}"
                                class="btn btn-dark px-4 rounded-pill">

                                <i class="fas fa-arrow-left me-2"></i>
                                Back

                            </a>

                        </div>

                    </div>

                </div>
                <div class="activity">
    <div class="mb-4">
        <h2 class="text-center text-primary">{{ $building->room_name }}</h2>
        <p class="text-muted">
            All Rooms Available
        </p>
    </div>

    @foreach($rooms as $room)

    
       

            <div class="row align-items-center">

                <!-- Image -->
                <div class="col-md-4 mb-3">

                    <img src="{{ asset('images/'.$room->image) }}"
                         class="img-fluid rounded"
                         style="height:220px;width:100%;object-fit:cover;">

                </div>

                <!-- Details -->
                <div class="col-md-8 mb-3">

                    <h4 class="fw-bold text-primary">
                        {{ $room->room_number }}
                    </h4>

                    <hr>

                    <p>
                        <strong>Price:</strong>
                        {{ $room->price }}
                    </p>

                    <p>
                        <strong>Description:</strong>
                        {{ $room->description }}
                    </p>
                    <p>
                        <strong>Area:</strong>
                        {{ $room->room_area }}
                    </p>

                    @if($room->status == "available")
                    <span class="badge bg-success">
                        {{ $room->status }}
                    </span>
                    @else
                    <span class="badge bg-danger">
                        {{ $room->status }}
                    </span>

                    @endif

                </div>

            </div>

 

    @endforeach

</div>
                


</div>

@endsection