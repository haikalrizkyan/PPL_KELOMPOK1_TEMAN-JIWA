<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Teman Jiwa'))</title>
    <link rel="icon" href="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Teman Jiwa') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #F5FAFA; /* Ditambahkan untuk konsistensi */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="@auth
                    @if(Auth::guard('psychologist')->check())
                        {{ route('psikolog.dashboard') }}
                    @elseif(Auth::guard('web')->check())
                        {{ route('dashboard') }}
                    @endif
                @else
                    {{ url('/') }}
                @endauth">
                    <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Logo Teman Jiwa" style="height: 40px; margin-right: 10px;">
                    <strong>Teman Jiwa</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto">
                        @auth
                        <li class="nav-item">
    @if(Auth::guard('psychologist')->check())
        <a class="nav-link {{ request()->routeIs('psikolog.dashboard') ? 'text-info fw-bold border-bottom border-info' : '' }}" 
           href="{{ route('psikolog.dashboard') }}">
            Home
        </a>
    @else
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'text-info fw-bold border-bottom border-info' : '' }}" 
           href="{{ route('dashboard') }}">
            Home
        </a>
    @endif
</li>

@if(Auth::guard('web')->check())
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('assessment.index') ? 'text-info fw-bold border-bottom border-info' : '' }}"
           href="{{ route('assessment.index') }}">
            Assessment
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('konsultasi.index') ? 'text-info fw-bold border-bottom border-info' : '' }}"
           href="{{ route('konsultasi.index') }}">
            Konsultasi
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('konsultasi.jadwal.user') ? 'text-info fw-bold border-bottom border-info' : '' }}"
           href="{{ route('konsultasi.jadwal.user') }}">
            Jadwal Konsultasi
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('article.index') ? 'text-info fw-bold border-bottom border-info' : '' }}"
           href="{{ route('article.index') }}">
            Artikel
        </a>
    </li>
                            @elseif(Auth::guard('psychologist')->check())
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('psikolog.assessment.*') ? 'text-info fw-bold border-bottom border-info' : '' }}" 
           href="{{ route('psikolog.assessment.index') }}">
           Kelola Assessment
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('psikolog.jadwal.konsultasi') ? 'text-info fw-bold border-bottom border-info' : '' }}" 
           href="{{ route('psikolog.jadwal.konsultasi') }}">
            Jadwal Konsultasi
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('psikolog.schedule.*') ? 'text-info fw-bold border-bottom border-info' : '' }}" 
           href="{{ route('psikolog.schedule.index') }}">
            Kelola Jadwal
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('psikolog.article.*') ? 'text-info fw-bold border-bottom border-info' : '' }}" 
           href="{{ route('psikolog.article.list') }}">
            Kelola Artikel
        </a>
    </li>
@endif

                        @endauth
                    </ul>

                    <!-- Right Side -->
                    @php
                        $isPsikologContext = request()->is('psikolog*') || request()->is('psikolog/*') || strpos(request()->path(), 'psikolog') !== false;
                    @endphp
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $isPsikologContext ? route('psikolog.login') : route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $isPsikologContext ? route('psikolog.register') : route('register') }}">Daftar</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->nama ?? Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::guard('psychologist')->check())
                                        <!-- Hanya tampilkan menu untuk psikolog -->
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('psikolog.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                                <i class="fas fa-user me-2"></i>Edit Profil
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('assessment.history') }}">
                                                <i class="fas fa-history me-2"></i>Riwayat Assessment
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <!-- Laravel JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>