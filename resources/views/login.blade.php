<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Building Rent Collection System</title>

    <!-- =====================================================
         BOOTSTRAP ONLINE
    ====================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- =====================================================
         BOOTSTRAP ICONS ONLINE
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {

            font-family: Arial, Helvetica, sans-serif;

            background:
                url('{{ asset("images/img11.jpeg") }}')
                no-repeat
                center
                center;

            background-size: cover;

            background-attachment: fixed;

        }


        /* =====================================================
           OVERLAY
        ===================================================== */

        .auth-wrapper {

            min-height: 100vh;

            width: 100%;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 20px;

            background:
                rgba(0, 0, 0, 0.45);

        }


        /* =====================================================
           LOGIN BOX
        ===================================================== */

        .login-box {

            width: 100%;

            max-width: 400px;

            background: rgba(255, 255, 255, 0.97);

            padding: 35px;

            border-radius: 15px;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.25);

        }


        /* =====================================================
           TITLE
        ===================================================== */

        .login-title {

            text-align: center;

            font-size: 30px;

            font-weight: 600;

            color: #111827;

            margin-bottom: 25px;

        }


        .login-subtitle {

            text-align: center;

            color: #6b7280;

            font-size: 14px;

            margin-bottom: 25px;

        }


        /* =====================================================
           LABEL
        ===================================================== */

        .form-label {

            font-weight: 600;

            color: #374151;

            margin-bottom: 7px;

        }


        /* =====================================================
           INPUT
        ===================================================== */

        .form-control {

            height: 48px;

            border-radius: 7px;

            border: 1px solid #d1d5db;

            padding: 10px 14px;

            font-size: 15px;

        }


        .form-control:focus {

            border-color: #146df5;

            box-shadow:
                0 0 0 0.20rem rgba(20, 109, 245, 0.15);

        }


        /* =====================================================
           PASSWORD ICON
        ===================================================== */

        .password-icon {

            cursor: pointer;

            background: #fff;

            border-left: none;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 0 15px;

        }


        .password-icon i {

            font-size: 18px;

            color: #555;

        }


        /* =====================================================
           FORGOT PASSWORD
        ===================================================== */

        .forgot-password {

            display: block;

            text-align: right;

            text-decoration: none;

            color: #146df5;

            font-size: 14px;

            margin-top: 5px;

            margin-bottom: 20px;

        }


        .forgot-password:hover {

            text-decoration: underline;

        }


        /* =====================================================
           LOGIN BUTTON
        ===================================================== */

        .login-button {

            height: 48px;

            border: none;

            border-radius: 7px;

            background: #146df5;

            font-size: 16px;

            font-weight: 600;

            transition: 0.3s;

        }


        .login-button:hover {

            background: #0759d4;

        }


        /* =====================================================
           HOME LINK
        ===================================================== */

        .home-link {

            color: #146df5;

            text-decoration: none;

            font-weight: 500;

        }


        .home-link:hover {

            text-decoration: underline;

        }


        /* =====================================================
           ALERTS
        ===================================================== */

        .success-message {

            background: #d1fae5;

            color: #065f46;

            border: 1px solid #a7f3d0;

            border-radius: 6px;

            padding: 10px;

            text-align: center;

            margin-bottom: 20px;

            font-size: 14px;

        }


        .error-message {

            background: #fee2e2;

            color: #991b1b;

            border: 1px solid #fecaca;

            border-radius: 6px;

            padding: 10px;

            text-align: center;

            margin-top: 20px;

            font-size: 14px;

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 576px) {

            .auth-wrapper {

                padding: 15px;

            }

            .login-box {

                padding: 25px 20px;

                border-radius: 12px;

            }

            .login-title {

                font-size: 26px;

            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     LOGIN WRAPPER
====================================================== -->

<div class="auth-wrapper">


    <!-- =================================================
         LOGIN BOX
    ================================================== -->

    <div class="login-box">


        <!-- TITLE -->

        <h3 class="login-title">
            Login
        </h3>


        <p class="login-subtitle">
            Login to your Building Rent Collection account
        </p>


        <!-- =================================================
             SUCCESS MESSAGE
        ================================================== -->

        @if(session("success"))

            <div class="success-message">

                {{ session("success") }}

            </div>

        @endif


        <!-- =================================================
             LOGIN FORM
        ================================================== -->

        <form action="{{ route('login') }}" method="POST">

            @csrf


            <!-- EMAIL -->

            <div class="mb-3">

                <label
                    for="email"
                    class="form-label"
                >
                    Email
                </label>


                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    placeholder="Enter email"
                    value="{{ old('email') }}"
                    required
                >

            </div>


            <!-- PASSWORD -->

            <div class="mb-2">

                <label
                    for="password"
                    class="form-label"
                >
                    Password
                </label>


                <div class="input-group">


                    <input
                        type="password"
                        name="password"
                        id="password"
                        autocomplete="current-password"
                        class="form-control"
                        placeholder="Enter password"
                        required
                    >


                    <span
                        class="input-group-text password-icon"
                        onclick="togglePassword()"
                    >

                        <i
                            class="bi bi-eye"
                            id="toggleIcon"
                        ></i>

                    </span>


                </div>

            </div>


            <!-- FORGOT PASSWORD -->

            <a
                href="{{ route('forgot') }}"
                class="forgot-password"
            >
                Forgot password?
            </a>


            <!-- LOGIN BUTTON -->

            <button
                class="btn btn-primary login-button w-100"
                type="submit"
            >

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Login

            </button>


            <!-- HOME -->

            <p class="text-center mt-4 mb-0">

                Don't have an account?

                <a
                    href="{{ route('home') }}"
                    class="home-link"
                >
                    Home
                </a>

            </p>


        </form>


        <!-- =================================================
             ERROR MESSAGE
        ================================================== -->

        @if(session("error"))

            <div class="error-message">

                {{ session("error") }}

            </div>

        @endif


    </div>

</div>


<!-- =====================================================
     PASSWORD TOGGLE
====================================================== -->

<script>

function togglePassword()
{

    let password =
        document.getElementById('password');

    let icon =
        document.getElementById('toggleIcon');


    if (password.type === 'password')
    {

        password.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    }

    else
    {

        password.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }

}

</script>


<!-- =====================================================
     BOOTSTRAP JAVASCRIPT
====================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>
