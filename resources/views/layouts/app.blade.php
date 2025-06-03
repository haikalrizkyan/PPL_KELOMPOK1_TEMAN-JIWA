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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4CA9A3;
            --secondary-color: #3D8C87;
            --text-color: #264653;
            --light-bg: #F4FAF9;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--light-bg);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .btn {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            border-radius: 2rem;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #2D6C67 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76,169,163,0.3);
        }

        .navbar {
            font-family: 'Poppins', sans-serif;
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-color) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .card {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .form-control {
            font-family: 'Poppins', sans-serif;
            border-radius: 1rem;
            border: 2px solid #E8F5F4;
            padding: 0.8rem 1.2rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
        }

        .form-label {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            color: var(--text-color);
        }

        .alert {
            font-family: 'Poppins', sans-serif;
            border-radius: 1rem;
            border: none;
        }

        .dropdown-menu {
            font-family: 'Poppins', sans-serif;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .dropdown-item {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--light-bg);
            color: var(--primary-color);
        }

        .badge {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
        }

        .table {
            font-family: 'Poppins', sans-serif;
        }

        .table thead th {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            border-top: none;
        }

        .pagination {
            font-family: 'Poppins', sans-serif;
        }

        .page-link {
            border-radius: 1rem;
            margin: 0 0.2rem;
            border: none;
            color: var(--text-color);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
        }

        .modal-content {
            border-radius: 1.5rem;
            border: none;
        }

        .modal-header {
            font-family: 'Poppins', sans-serif;
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .toast {
            font-family: 'Poppins', sans-serif;
            border-radius: 1rem;
            border: none;
        }

        .toast-header {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
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
        <a class="nav-link {{ request()->is('assessment/history') ? 'text-info fw-bold border-bottom border-info' : '' }}" href="{{ route('assessment.history') }}">
        Riwayat Assessment
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
                                        <!-- Hanya tampilkan menu untuk psikolog 
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('psikolog.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>-->
                                        <li>
                                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </a>
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
                                        <!--<li>
                                            <a class="dropdown-item" href="{{ route('assessment.history') }}">
                                                <i class="fas fa-history me-2"></i>Riwayat Assessment
                                            </a>
                                        </li> -->
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