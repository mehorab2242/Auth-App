<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

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
        .login-card {
            border: 3px solid #f1f1f1;
            max-width: 800px;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .login-card h3 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-control {
            margin-bottom: 15px;
            padding: 12px 15px;
        }
        .btn-login {
            background-color: #04AA6D;
            color: #fff;
            padding: 14px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
        }
        .btn-login:hover {
            opacity: 0.9;
        }
        .btn-cancel {
            background-color: #f44336;
            color: white;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
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
    <div class="login-card row g-0">

        <!-- Login Form -->
        <div class="col-md-6 p-4">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <h3>Login Page</h3>

                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required class="form-control">

                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required class="form-control">

                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-login">Login</button>

                <!-- Validation errors -->
                @if($errors->any())
                    <ul class="error-list mt-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <button type="button" class="btn btn-cancel mt-3">Cancel</button>
                <button type="button" class="btn btn-outline-primary w-100 rounded-3 mt-2" onclick="window.location.href='register'">
                    Register
                </button>
            </form>
        </div>

        <!-- Image -->
        <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
            <img class="img-fluid p-4" src="images/login.svg" alt="Login Illustration">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
