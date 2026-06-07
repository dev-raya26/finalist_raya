<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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
            background: rgba(0,0,0,0.4); 
        }

        .login-box{
            width:380px;
            background:#fff;
            padding:30px;
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>

<div class="auth-wrapper">

    <div class="login-box">
        <h3 class="text-center mb-4">Resest password form</h3>
        <br>
        @if(session("success"))
        <span style="color: green;text-align: center">{{ session("success") }}</span>
        @endif
        <span></span>

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email">
            </div>

            <button class="btn btn-primary w-100" type="submit">Send link</button>

            <p class="text-center mt-3">
                <a href="{{ route('showlogin') }}">Back to login</a>
            </p>
        </form>
    </div>

</div>

</body>
</html>