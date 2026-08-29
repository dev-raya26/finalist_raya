@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

@section('content')
<div class="main">
    <div class="activity p-3 p-md-4" style="height: 100vh">
        
        <!-- PAGE HEADER -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold text-success m-0">
                <i class="bi bi-gear-fill me-2"></i>Account Settings
            </h3>
        </div>

        <!-- MESSAGES / ALERTS -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- MAIN CARD CONTAINER -->
        <div class="card shadow-sm border-0 rounded-3">
            
            <!-- TABS HEADER -->
            <div class="card-header bg-white border-bottom pt-3 px-4">
                <ul class="nav nav-tabs card-header-tabs border-bottom-0" id="settingsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold text-dark" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                            <i class="bi bi-person-circle me-1 text-success"></i> Profile Details
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold text-dark" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">
                            <i class="bi bi-shield-lock me-1 text-success"></i> Change Password
                        </button>
                    </li>
                </ul>
            </div>

            <!-- TABS CONTENT BODY -->
            <div class="card-body p-4">
                <div class="tab-content" id="settingsTabContent">
                    
                    <!-- TAB 1: PROFILE DETAILS -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('settings.update-profile') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">First Name</label>
                                    <input type="text" name="firstname" class="form-control" value="{{ old('firstname', Auth::user()->firstname ?? Auth::user()->name) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" value="{{ old('lastname', Auth::user()->lastname ?? '') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone ?? '') }}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold text-secondary">Role</label>
                                    <input type="text" class="form-control bg-light text-capitalize" value="{{ Auth::user()->role }}" readonly>
                                </div>

                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-success px-4 fw-medium">
                                        <i class="bi bi-download me-1"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TAB 2: CHANGE PASSWORD -->
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <form action="{{ route('settings.update-password') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-secondary">Current Password</label>
                                    <input type="password" name="current_password" class="form-control" placeholder="Enter your current password" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">New Password</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm new password" required>
                                </div>

                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-success px-4 fw-medium">
                                        <i class="bi bi-key me-1"></i> Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@endsection