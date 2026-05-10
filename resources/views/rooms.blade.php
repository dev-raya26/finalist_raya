@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="main">

    <div class="activity">
        <h3>Rooms Management</h3>

        <!-- ADD BUTTON -->
        @if(Auth::user()->role=="landload")

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            + Add Room
        </button>
        @endif

        <div class="user-list">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Room No</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->price }}</td>
                            <td>{{ $room->type }}</td>
                            <td>
                                <span class="badge bg-success">{{ $room->status }}</span>
                            </td>
                            <td>
                                <img src="{{ asset('images/'.$room->image) }}" width="60" style="border-radius:10px;">
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm editBtn"
                                    data-id="{{ $room->id }}"
                                    data-room_number="{{ $room->room_number }}"
                                    data-price="{{ $room->price }}"
                                    data-type="{{ $room->type }}"
                                    data-status="{{ $room->status }}"
                                    data-description="{{ $room->description }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No rooms found</td>
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

            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5>Add Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <select name="building_id" class="form-select mb-2">
                        <option value="">--Select building</option>

                        @foreach ($buildings as $b)
                        <option value="{{ $b->id }}">{{ $b->room_name }}</option>
                            
                        @endforeach
                    </select>

                    <input type="text" name="room_number" class="form-control mb-2" placeholder="Room Number">

                    <input type="number" name="price" class="form-control mb-2" placeholder="Price">

                    <input type="text" name="type" class="form-control mb-2" placeholder="Type (Single, Double...)">
                    <input type="hidden" name="status" value="available">

                    

                    <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

                    <input type="file" name="image" class="form-control mb-2">

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

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" id="room_number" name="room_number" class="form-control mb-2">

                    <input type="number" id="price" name="price" class="form-control mb-2">

                    <input type="text" id="type" name="type" class="form-control mb-2">

                    <select id="status" name="status" class="form-control mb-2">
                        <option value="available">Available</option>
                        <option value="occupied">Occupied</option>
                    </select>

                    <textarea id="description" name="description" class="form-control mb-2"></textarea>

                    <input type="file" name="image" class="form-control mb-2">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- ================= SCRIPT ================= -->
<script>
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('editForm').action = "/rooms/" + id;

        document.getElementById('room_number').value = this.dataset.room_number;
        document.getElementById('price').value = this.dataset.price;
        document.getElementById('type').value = this.dataset.type;
        document.getElementById('status').value = this.dataset.status;
        document.getElementById('description').value = this.dataset.description;

    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection