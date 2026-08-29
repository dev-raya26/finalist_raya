<!DOCTYPE html>
<html>
<head>
    <title>Login Blocked</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .blocked-box {
            background: white;
            width: 400px;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .blocked-box h2 {
            color: #d9534f;
        }

        .blocked-box p {
            color: #555;
        }

        #timer {
            font-size: 25px;
            font-weight: bold;
            color: #d9534f;
        }
    </style>
</head>

<body>

<div class="blocked-box">

    <h2>Login Blocked</h2>

    <p>
        You entered an incorrect password 3 times.
    </p>

    <p>
        Please wait:
    </p>

    <div id="timer">
        {{ session('seconds', 60) }}
    </div>

    <p>seconds</p>

</div>

<script>

    let seconds = {{ session('seconds', 60) }};

    let timer = setInterval(function () {

        seconds--;

        document.getElementById('timer').innerHTML = seconds;

        if (seconds <= 0) {

            clearInterval(timer);

            // Rudisha kwenye login baada ya seconds 30
            window.location.href = "{{ route('showlogin') }}";
        }

    }, 1000);

</script>

</body>
</html>