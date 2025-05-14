@extends('layouts.app')

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

        <!-- Top Up Saldo Section -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4 class="mb-0">Top Up Saldo</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('topup') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="amount" class="form-label">Jumlah Saldo</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Masukkan jumlah saldo" required>
                            </div>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="bank_transfer">Transfer Bank</option>
                                    <option value="gopay">Gopay</option>
                                    <option value="ovo">OVO</option>
                                    <option value="dana">DANA</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Top Up</button>
                                <a href="#" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
