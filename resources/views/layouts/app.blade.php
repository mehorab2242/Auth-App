<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    @vite('resources/css/app.css') {{-- Only if you’re using Laravel with Vite & Tailwind --}}
</head>
<body class="bg-gray-50 font-sans">

<header class="bg-blue-600 text-white p-4">
    <div class="container mx-auto">
        <h1 class="text-xl font-bold">Notes App</h1>
    </div>
</header>

<main class="container mx-auto p-6">
    {{-- Page-specific content will go here --}}
    @yield('content')
</main>

<footer class="bg-gray-200 p-4 mt-6 text-center text-sm text-gray-700">
    &copy; {{ date('Y') }} Notes App. All rights reserved.
</footer>

</body>
</html>
