<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Building Rent Collection System</title>


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
            min-height: 100%;
        }


        body {

            font-family: Arial, Helvetica, sans-serif;

            background:
                url('{{ asset("images/img11.jpeg") }}')
                no-repeat
                center center;

            background-size: cover;

            background-attachment: fixed;

        }


        /* =====================================================
           MAIN WRAPPER
        ===================================================== */

        .auth-wrapper {

            min-height: 100vh;

            width: 100%;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 30px 15px;

            position: relative;

        }


        /* =====================================================
           DARK OVERLAY
        ===================================================== */

        .auth-wrapper::before {

            content: "";

            position: fixed;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            background:
                rgba(0, 0, 0, 0.50);

            z-index: 0;

        }


        /* =====================================================
           FORM AREA
        ===================================================== */

        .auth-right {

            position: relative;

            z-index: 2;

            width: 100%;

            display: flex;

            justify-content: center;

            align-items: center;

        }


        /* =====================================================
           REGISTER BOX
        ===================================================== */

        .register-box {

            width: 100%;

            max-width: 750px;

            background:
                rgba(255, 255, 255, 0.98);

            padding: 35px;

            border-radius: 15px;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.25);

        }


        /* =====================================================
           TITLE
        ===================================================== */

        .register-title {

            text-align: center;

            font-size: 30px;

            font-weight: 600;

            color: #111827;

            margin-bottom: 8px;

        }


        .register-subtitle {

            text-align: center;

            color: #6b7280;

            font-size: 14px;

            margin-bottom: 28px;

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

            height: 46px;

            border-radius: 7px;

            border: 1px solid #d1d5db;

            padding: 10px 13px;

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

            height: 46px;

            background: #fff;

            cursor: pointer;

            padding-left: 14px;

            padding-right: 14px;

        }


        .password-icon i {

            font-size: 18px;

            color: #555;

        }


        /* =====================================================
           REGISTER BUTTON
        ===================================================== */

        .register-button {

            height: 48px;

            border: none;

            border-radius: 7px;

            background: #198754;

            font-size: 16px;

            font-weight: 600;

            transition: 0.3s;

        }


        .register-button:hover {

            background: #157347;

        }


        /* =====================================================
           LOGIN LINK
        ===================================================== */

        .login-link {

            color: #146df5;

            text-decoration: none;

            font-weight: 500;

        }


        .login-link:hover {

            text-decoration: underline;

        }


        /* =====================================================
           SUCCESS MESSAGE
        ===================================================== */

        .success-message {

            background: #d1fae5;

            color: #065f46;

            border: 1px solid #a7f3d0;

            border-radius: 7px;

            padding: 10px;

            text-align: center;

            margin-bottom: 20px;

            font-size: 14px;

        }


        /* =====================================================
           PASSWORD MATCH MESSAGE
        ===================================================== */

        #message {

            display: block;

            margin-top: 6px;

            font-size: 13px;

            font-weight: 500;

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 768px) {

            .auth-wrapper {

                padding: 20px 12px;

            }


            .register-box {

                padding: 25px 20px;

            }


            .register-title {

                font-size: 26px;

            }

        }


        @media (max-width: 576px) {

            .register-box {

                padding: 22px 16px;

            }


            .register-title {

                font-size: 24px;

            }


            .form-control {

                height: 44px;

            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     MAIN WRAPPER
====================================================== -->

<div class="auth-wrapper">


    <div class="auth-right">


        <!-- =================================================
             REGISTER BOX
        ================================================== -->

        <div class="register-box">


            <!-- TITLE -->

            <h3 class="register-title">
                Create Account
            </h3>


            <p class="register-subtitle">
                Register to use the Building Rent Collection System
            </p>


            <!-- =================================================
                 SUCCESS MESSAGE
            ================================================== -->

            @if(session('success'))

                <div class="success-message">

                    {{ session('success') }}

                </div>

            @endif


            <!-- =================================================
                 FORM
            ================================================== -->

            <form
                action="{{ route('reguser.store') }}"
                method="POST"
            >

                @csrf


                <!-- =================================================
                     ROW 1
                ================================================== -->

                <div class="row mb-3">


                    <!-- FIRST NAME -->

                    <div class="col-md-4 mb-3 mb-md-0">

                        <label
                            for="firstname"
                            class="form-label"
                        >
                            First Name
                        </label>


                        <input
                            type="text"
                            name="firstname"
                            id="firstname"
                            value="{{ old('firstname') }}"
                            class="form-control @error('firstname') is-invalid @enderror"
                            placeholder="First name"
                            required
                        >


                        @error('firstname')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- MIDDLE NAME -->

                    <div class="col-md-4 mb-3 mb-md-0">

                        <label
                            for="middlename"
                            class="form-label"
                        >
                            Middle Name
                        </label>


                        <input
                            type="text"
                            name="middlename"
                            id="middlename"
                            value="{{ old('middlename') }}"
                            class="form-control @error('middlename') is-invalid @enderror"
                            placeholder="Middle name"
                        >


                        @error('middlename')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- LAST NAME -->

                    <div class="col-md-4">

                        <label
                            for="lastname"
                            class="form-label"
                        >
                            Last Name
                        </label>


                        <input
                            type="text"
                            name="lastname"
                            id="lastname"
                            value="{{ old('lastname') }}"
                            class="form-control @error('lastname') is-invalid @enderror"
                            placeholder="Last name"
                            required
                        >


                        @error('lastname')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>


                <!-- =================================================
                     ROW 2
                ================================================== -->

                <div class="row mb-3">


                    <!-- EMAIL -->

                    <div class="col-md-4 mb-3 mb-md-0">

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
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter email"
                            required
                        >


                        @error('email')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- PHONE -->

                    <div class="col-md-4 mb-3 mb-md-0">

                        <label
                            for="phone"
                            class="form-label"
                        >
                            Phone
                        </label>


                        <input
                            type="tel"
                            name="phone"
                            id="phone"
                            value="{{ old('phone') }}"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Enter phone number"
                            maxlength="10"
                            required
                        >


                        @error('phone')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- PASSWORD -->

                    <div class="col-md-4">

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
                                autocomplete="new-password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter password"
                                required
                            >


                            <span
                                class="input-group-text password-icon"
                                onclick="togglePassword(
                                    'password',
                                    'toggleIcon1'
                                )"
                            >

                                <i
                                    class="bi bi-eye"
                                    id="toggleIcon1"
                                ></i>

                            </span>


                        </div>


                        @error('password')

                            <div class="text-danger mt-1"
                                 style="font-size:13px;">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                </div>


                <!-- =================================================
                     CONFIRM PASSWORD
                ================================================== -->

                <div class="row mb-3">


                    <div class="col-md-12">


                        <label
                            for="confirmPassword"
                            class="form-label"
                        >
                            Confirm Password
                        </label>


                        <div class="input-group">


                            <input
                                type="password"
                                name="password_confirmation"
                                id="confirmPassword"
                                class="form-control"
                                placeholder="Confirm password"
                                required
                            >


                            <span
                                class="input-group-text password-icon"
                                onclick="togglePassword(
                                    'confirmPassword',
                                    'toggleIcon2'
                                )"
                            >

                                <i
                                    class="bi bi-eye"
                                    id="toggleIcon2"
                                ></i>

                            </span>


                        </div>


                        <small id="message"></small>


                    </div>


                </div>


                <!-- =================================================
                     ROLE
                ================================================== -->

                <input
                    type="hidden"
                    name="role"
                    value="customer"
                >


                <!-- =================================================
                     REGISTER BUTTON
                ================================================== -->

                <button
                    class="btn btn-success register-button w-100 mt-3"
                    type="submit"
                >

                    <i class="bi bi-person-plus me-2"></i>

                    Register

                </button>


                <!-- =================================================
                     LOGIN
                ================================================== -->

                <p class="text-center mt-4 mb-0">

                    Already have an account?

                    <a
                        href="{{ route('showlogin') }}"
                        class="login-link"
                    >
                        Login
                    </a>

                </p>


            </form>


        </div>

    </div>

</div>


<!-- =====================================================
     PASSWORD TOGGLE
====================================================== -->

<script>

function togglePassword(inputId, iconId)
{

    let input =
        document.getElementById(inputId);

    let icon =
        document.getElementById(iconId);


    if (input.type === "password")
    {

        input.type = "text";

        icon.classList.remove("bi-eye");

        icon.classList.add("bi-eye-slash");

    }

    else
    {

        input.type = "password";

        icon.classList.remove("bi-eye-slash");

        icon.classList.add("bi-eye");

    }

}

</script>


<!-- =====================================================
     PASSWORD MATCH
====================================================== -->

<script>

const password =
    document.getElementById('password');

const confirmPassword =
    document.getElementById('confirmPassword');

const message =
    document.getElementById('message');


function checkPassword()
{

    if (confirmPassword.value === "")
    {

        message.innerHTML = "";

        return;

    }


    if (password.value !== confirmPassword.value)
    {

        message.innerHTML =
            "Password does not match";

        message.style.color = "red";

    }

    else
    {

        message.innerHTML =
            "Password matched successfully";

        message.style.color = "green";

    }

}


password.addEventListener(
    'keyup',
    checkPassword
);


confirmPassword.addEventListener(
    'keyup',
    checkPassword
);

</script>


<!-- =====================================================
     BOOTSTRAP JAVASCRIPT
====================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>
