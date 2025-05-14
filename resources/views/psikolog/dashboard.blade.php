@extends('psikolog.layouts.app')

@section('title', 'Home - Teman Jiwa')


@section('content')
<div class="container">
    <div class="text-center py-5">
        <h2 class="mb-4">Haloo!!</h2>
        <p class="text-muted">Selamat datang, {{ $user->name }}!</p>

        <!-- Menampilkan Saldo Pengguna -->
        <div class="alert alert-info">
            <strong>Saldo Anda:</strong> Rp {{ number_format($user->saldo, 0, ',', '.') }}
        </div>

    </div>
</div>
@endsection
