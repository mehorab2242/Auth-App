<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            font-family: "Open Sans", sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #6c757d; /* Bootstrap's secondary */
        }
        .register-card {
            border: 3px solid #f1f1f1;
            max-width: 900px;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .register-card h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
            padding: 12px 15px;
        }
        .btn-register {
            background-color: #04AA6D;
            color: #fff;
            padding: 14px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
        }
        .btn-register:hover {
            opacity: 0.9;
        }
        .error-list {
            background: #fee2e2;
            padding: 10px 15px;
            border-radius: 8px;
            color: #b91c1c;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-card row g-0">

        <!-- Register Form -->
        <div class="col-md-6 p-4">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <h3>Register</h3>
                <p class="text-muted text-center mb-4">Please fill in this form to create an account.</p>

                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required class="form-control">

                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required class="form-control">

                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required class="form-control">

                <label for="password_confirmation" class="form-label fw-bold">Repeat Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password" required class="form-control">

                <p class="small mt-3">By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <button type="submit" class="btn btn-register">Register</button>

                <!-- Validation errors -->
                @if($errors->any())
                    <ul class="error-list mt-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="text-center mt-3">
                    <p>Already have an account? <a href="{{ route('login') }}">Log in</a>.</p>
                </div>
            </form>
        </div>

        <!-- Image -->
        <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
            <img class="img-fluid p-4" src="images/register.svg" alt="Register Illustration">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
