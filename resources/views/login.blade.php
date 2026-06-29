<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        <h3 class="text-center mb-4">Login</h3>
        <br>
        @if(session("success"))
        <span style="color: green;text-align: center">{{ session("success") }}</span>
        @endif
        
        <span></span>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email">
            </div>

            <div class="mb-3">
    <label>Password</label>

    <div class="input-group">
        <input type="password"
               name="password"
               id="password"
               autocomplete="new-password"
               class="form-control"
               placeholder="Enter password">

        <span class="input-group-text"
              style="cursor:pointer;"
              onclick="togglePassword()">
            <i class="bi bi-eye" id="toggleIcon"></i>
        </span>
    </div>
</div>

            <a href="{{ route('forgot') }}" style="text-align: right">Forgot password?</a>

            <button class="btn btn-primary w-100" type="submit">Login</button>

            <p class="text-center mt-3">
                No account? <a href="{{ route('home') }}">home</a>
            </p>
        </form>
        @if(session("error"))
        <span style="color: red;text-align: center">{{ session("error") }}</span>
        @endif
    </div>

</div>
<script>
function togglePassword() {
    let password = document.getElementById('password');
    let icon = document.getElementById('toggleIcon');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
</body>
</html>