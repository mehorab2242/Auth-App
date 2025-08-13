<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: "Open Sans", sans-serif;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: auto;
    }
    /* Bordered form */
    form {
        max-width: 800px;
        margin: 0 auto;
        border: 3px solid #f1f1f1;
    }

    /* Full-width inputs */
    input, input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    /* Add a hover effect for buttons */
    button:hover {
        opacity: 0.8;
    }

    /* Extra style for the cancel button (red) */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the avatar image inside this container */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    /* Avatar image */
    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* The "Forgot password" text */
    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }

</style>

<body class="bg-secondary">
<section class="d-flex justify-content-between">
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('login') }}" method="POST" class="p-3 rounded-4 bg-white shadow-lg">
            @csrf

            <h3 style="text-align: center; margin: 30px 0"> Login page</h3>

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" required class="form-control">

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required class="form-control">

                <button type="submit" class="rounded-3">Login</button>

                <label style="display: inline-flex">
                    <input type="checkbox" name="remember" style="width: 20px;"> Remember me
                </label>
            </div>
            <!-- Validation errors -->
            @if($errors->any())
                <ul class="px-4 py-2 bg-red-100">
                    @foreach($errors->all() as $error)
                        <li class="my-2 text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="container">
                <button  type="button" class="btn btn-outline-danger w-100 rounded-3 py-2">Cancel</button>
                {{--        <span class="psw">Forgot <a href="{{ route('password.request') }}">password?</a></span>--}}
            </div>

            <div class="container">
                <button class="rounded-3" onclick="window.location.href='register'">Register</button>

                <button class="rounded-3" onclick="window.location.href='/'">Home</button>
            </div>
        </form>
    </div>
    <div class="col-md-6 align-items-center d-flex">
        <div class=""><img class="w-75" src="images/login.svg" alt=""></div>

    </div>
</div>
</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
