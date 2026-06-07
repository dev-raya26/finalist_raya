@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')

<div class="main">
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