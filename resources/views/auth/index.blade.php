@extends('layouts.app')

@push('body-class')
    home-bg
@endpush

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="home-overlay text-center">
            <h2 class="mb-4">Welcome to Notes App</h2>

            {{-- Success message --}}
            @if(session('success'))
                <div class="alert alert-success w-100 text-center">
                    {{ session('success') }}
                </div>
            @endif

            @guest
                <div class="d-flex gap-3 flex-wrap justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-person-plus"></i> Register
                    </a>
                </div>
            @endguest

            @auth
                <p class="mb-3">Welcome, <strong>{{ Auth::user()->name }}</strong>!</p>
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <a href="{{ route('notes.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-journal-text"></i> My Notes
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
@endsection
