@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="main">

    <div class="activity">
        <h3>Building Management</h3>

        <!-- ADD BUTTON -->
        
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            + Add building
        </button>
      

        <div class="user-list">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Building Name</th>
                        <th>Building status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->room_name }}</td>
                           <td>
    @if($room->status == "Active")
        <span class="badge bg-success">
            Active
        </span>
    @else
        <span class="badge bg-danger">
            Blocked
        </span>
    @endif
</td>
          <td>

    <a href="{{ route('buildings.show', $room->id) }}"
       class="btn btn-info btn-sm">
        <i class="fas fa-eye"></i>
    </a>

    <button class="btn btn-primary btn-sm editBtn"
        data-id="{{ $room->id }}"
        data-room_name="{{ $room->room_name }}"
        data-location="{{ $room->location }}"
        data-description="{{ $room->description }}"
        data-bs-toggle="modal"
        data-bs-target="#editModal">
        <i class="fas fa-edit"></i>
    </button>

    <form action="{{ route('buildings.toggleStatus', $room->id) }}"
          method="POST"
          class="d-inline">
        @csrf
        @method('PUT')

        @if($room->status == 'Active')

            <button type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Block this building?')">
                <i class="fas fa-ban"></i> Block
            </button>

        @else

            <button type="submit"
                    class="btn btn-success btn-sm"
                    onclick="return confirm('Activate this building?')">
                <i class="fas fa-check"></i> Activate
            </button>

        @endif

    </form>

</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No rooms found</td>
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

            <form action="{{ route('buildings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5>Add building</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="room_name" class="form-control mb-2" placeholder="Building Name eg apartment.." required>

                    <input type="text" name="location" class="form-control mb-2" placeholder="Location" required>

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

                    <input type="text" id="room_name" name="room_name" class="form-control mb-2">

                    <input type="text" id="location" name="location" class="form-control mb-2">

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

<!-- ================= SCRIPT ================= -->
<script>
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('editForm').action = "/buildings/" + id;

        document.getElementById('room_name').value = this.dataset.room_name;
        document.getElementById('location').value = this.dataset.location;
        document.getElementById('description').value = this.dataset.description;

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