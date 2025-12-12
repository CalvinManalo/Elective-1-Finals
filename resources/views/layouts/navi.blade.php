<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FEU Cavite Alumni Platform')</title>

    <link rel="stylesheet" href="{{ asset('css/alumni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cal.css') }}">

    {{-- BOOTSTRAP CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- GLOBAL CSS --}}
    <link rel="stylesheet" href="{{ asset('css/navi.css') }}">

    {{-- TAILWIND CSS for header --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- PAGE CSS --}}
    @stack('styles')
</head>
<body style="margin:0; padding:0; font-family:Arial, sans-serif;">

    {{-- HEADER --}}
    @php $align = $align ?? 'center'; @endphp
    <div class="w-full bg-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center {{ $align === 'left' ? 'justify-start' : 'justify-center' }}">
            <img src="{{ asset('images/header.png') }}" alt="Header image" class="h-16 object-contain">
        </div>
    </div>

    {{-- NAV --}}
    <nav style="background:#145c2f; padding:12px; display:flex; justify-content:space-between; align-items:flex-end; border-bottom:3px solid #0b6e2d;">
        {{-- Bottom-left: User Name / Profile / Log Out --}}
        <div style="align-self:flex-end; display:flex; gap:15px; align-items:center;">
            @if(Auth::check())
                <span style="color:white; font-weight:bold;">{{ Auth::user()->name }}</span>
                <a href="/profile" style="color:white; font-weight:bold; text-decoration:none;">Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:white; font-weight:bold; cursor:pointer; padding:0;">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color:white; font-weight:bold; text-decoration:none;">Login</a>
            @endif
        </div>

        {{-- Right side: Main navigation --}}
        <div style="display:flex; gap:20px;">
            <a href="{{ route('dashboard') }}" style="color:white; font-weight:bold; text-decoration:none;">Dashboard</a>
            <a href="{{ url('/home') }}" style="color:white; font-weight:bold; text-decoration:none;">Home</a>
            <a href="{{ url('/alumni') }}" style="color:white; font-weight:bold; text-decoration:none;">Alumni</a>
            <a href="{{ url('/forum') }}" style="color:white; font-weight:bold; text-decoration:none;">Forum</a>
            <a href="{{ url('/calendar') }}" style="color:white; font-weight:bold; text-decoration:none;">Calendar</a>
            <a href="{{ url('/opportunities') }}" style="color:white; font-weight:bold; text-decoration:none;">Opportunities</a>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main style="padding:25px;">
        @yield('content')
    </main>

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- PAGE SCRIPTS --}}
    @stack('scripts')

</body>
</html>
