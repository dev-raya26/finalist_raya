<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .auth-wrapper{
            height:100vh;
            display:flex;
        }

      

        .auth-right{
            flex:1;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#f8f9fa;
        }

        .login-box{
            width:380px;
            background:#fff;
            padding:30px;
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="auth-wrapper">

  

    <!-- RIGHT FORM -->
    <div class="auth-right">

        <div class="login-box">
            <h3 class="text-center mb-4">Login</h3>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                </div>

                <button class="btn btn-primary w-100" type="submit">Login</button>

                <p class="text-center mt-3">
                    No account? <a href="{{ route('home') }}">home</a>
                </p>
            </form>

        </div>

    </div>

</div>

</body>
</html>