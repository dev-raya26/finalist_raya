<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

 <style>
    body{
        margin:0;
        padding:0;
        height:100vh;
        background: url('{{ asset("images/img11.jpeg") }}') no-repeat center center;
        background-size: cover;
    }

    .auth-wrapper{
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        position:relative;
    }

    /* OVERLAY YA GIZA JUU YA PICHA */
    .auth-wrapper::before{
        content:"";
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
        z-index:1;
    }

    .auth-right{
        position:relative;
        z-index:2;
        display:flex;
        align-items:center;
        justify-content:center;
        width:100%;
        padding:20px;
        background:transparent; /* muhimu sana */
    }

    .register-box{
        width:90%;
        max-width:700px;
        background:#fff;
        padding:30px;
        border-radius:12px;
        box-shadow:0 10px 30px rgba(0,0,0,0.2);
    }
</style>
</head>

<body>

<div class="auth-wrapper">

  

    <!-- FORM -->
    <div class="auth-right">

        <div class="register-box">

            <h3 class="text-center mb-4">Create Account</h3>

            <form action="{{ route('reguser.store') }}" method="POST">
            @csrf
                <!-- ROW 1 -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>Middle Name</label>
                        <input type="text" name="middlename" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control">
                    </div>
                </div>

                <!-- ROW 2 -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                   
                </div>

                <!-- ROW 3 -->
                <div class="row mb-3">
                    

                    <div class="col-md-12">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <input type="hidden" name="role" value="customer">
                    </div>
                </div>

                <button class="btn btn-success w-100 mt-3" type="submit">Register</button>

                <p class="text-center mt-3">
                    Already have account? <a href="{{ route('showlogin') }}">Login</a>
                </p>

            </form>

        </div>

    </div>

</div>

</body>
</html>