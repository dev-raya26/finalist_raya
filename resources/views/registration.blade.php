@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<div class="main">

    <div class="activity">
        <h3>Users Management</h3>

        <!-- BUTTON YA KUFUNGUA MODAL -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
            + Add User
        </button>

        <div class="user-list">
           <table class="table table-striped">
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Lastname</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->middlename }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge bg-info">
                        {{ $user->role }}
                    </span>
                </td>
                <td>
    <button class="btn btn-sm btn-warning editBtn"
        data-id="{{ $user->id }}"
        data-firstname="{{ $user->firstname }}"
        data-middlename="{{ $user->middlename }}"
        data-lastname="{{ $user->lastname }}"
        data-phone="{{ $user->phone }}"
        data-email="{{ $user->email }}"
        data-role="{{ $user->role }}"
        data-status="{{ $user->status }}"
        data-bs-toggle="modal"
        data-bs-target="#editModal">
        Edit
    </button>
</td>
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="user_id">

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input type="text" id="firstname" name="firstname" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="text" id="middlename" name="middlename" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input type="text" id="lastname" name="lastname" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                      
                    </div>

                   

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    No users found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
        </div>
    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('reguser.store') }}" method="POST">
    @csrf

    <div class="modal-header">
        <h5 class="modal-title">Register User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">

        <!-- Row 1 -->
        <div class="row">
            <div class="col-md-6 mb-2">
                <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" name="middlename" class="form-control" placeholder="Middle Name">
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row">
            <div class="col-md-6 mb-2">
                <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" name="phone" class="form-control" placeholder="Phone" required>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row">
            <div class="col-md-6 mb-2">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-md-6 mb-2">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
        </div>

        <!-- Row 4 -->
        <div class="row">
            <div class="col-md-12 mb-2">
                <select name="role" class="form-control">
                    <option value="">-- Select Role --</option>
                    <option value="admin">Admin</option>
                    <option value="landload">Landload</option>
                </select>
            </div>
           
        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save User</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

</form>

        </div>
    </div>
</div>
<script>
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('editForm').action = "/reguser/" + id;

        document.getElementById('firstname').value = this.dataset.firstname;
        document.getElementById('middlename').value = this.dataset.middlename;
        document.getElementById('lastname').value = this.dataset.lastname;
        document.getElementById('phone').value = this.dataset.phone;
        document.getElementById('email').value = this.dataset.email;

    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection