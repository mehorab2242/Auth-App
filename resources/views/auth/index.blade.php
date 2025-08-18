<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h2>Welcome to home page</h2>
@if(session('success'))
    <div id="flash" class="p-4 text-center bg-green-50 text -green-500 font-bold">
        {{session('success')}}
    </div>
@endif
<!-- Buttons with routing -->
@guest
<button onclick="window.location.href='login'">Login</button>
<button onclick="window.location.href='register'">Register</button>
@endguest
@auth
    <span class="border-r-2 pr-2">
    Welcome to the page, {{ Auth::user()->name }}
</span>
    <div class="flex gap-2 items-center">
        <a href="{{ route('notes.index') }}" class="btn">Notes</a>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button class="btn">Logout</button>
        </form>
    </div>
@endauth

</body>
</html>
