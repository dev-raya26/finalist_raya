<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <style>
        .auth-wrapper{
            height:100vh;
            display:flex;
        }

        

        .auth-left::before{
            content:"";
            position:absolute;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.6);
        }

        .auth-right{
            flex:1;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#f8f9fa;
            overflow:auto;
            padding:20px;
        }

        .register-box{
            width:90%;
            max-width:700px;
            background:#fff;
            padding:30px;
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
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