@extends('layouts.app')

@section('title', 'Home - Teman Jiwa')


@section('content')
<style>
    body {
        background: #F4FAF9;
        font-family: 'Poppins', sans-serif;
    }
    .dashboard-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #264653;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    .dashboard-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
        margin-bottom: 2rem;
    }
    .dashboard-section {
        margin-bottom: 2.5rem;
    }
    .dashboard-divider {
        border-top: 2px dashed #A8E6CF;
        margin: 2.5rem 0 2rem 0;
    }
    .dashboard-icon {
        font-size: 2rem;
        color: #fff;
        margin-bottom: 0.2rem;
    }
    .btn-custom {
        background: #4CA9A3;
        color: #fff;
        border: none;
        border-radius: 2rem;
        font-weight: 600;
        padding: 0.6rem 2rem;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 16px 0 rgba(76,169,163,0.12);
        font-size: 1.1rem;
    }
    .btn-custom:hover {
        background: #3D8C87;
        color: #fff;
        box-shadow: 0 8px 24px 0 rgba(76,169,163,0.18);
    }
    .card-modern {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
        border: none;
        max-width: 500px;
        margin: 0 auto;
    }
    .card-header-modern {
        background: linear-gradient(90deg, #4CA9A3 0%, #A8E6CF 100%);
        color: #fff;
        font-size: 1.15rem;
        font-weight: 700;
        border-radius: 1.5rem 1.5rem 0 0;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem 1rem 0.6rem 1rem;
    }
    .monitoring-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        color: #fff;
        letter-spacing: 0.5px;
    }
    .monitoring-info {
        font-size: 0.95rem;
        color: #264653;
        font-weight: 500;
        margin-bottom: 0.4rem;
    }
    .monitoring-label {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .monitoring-value {
        color: #264653;
        font-size: 0.95rem;
        font-weight: 600;
    }
    .badge-soft {
        background: #e0f7f7;
        color: #3b7c7c;
        font-size: 0.9em;
        border-radius: 1rem;
        padding: 0.3em 0.8em;
        font-weight: 600;
    }
    .badge-sehat {
        background: #66BB6A !important;
        color: #fff !important;
        font-size: 0.9em;
        border-radius: 1rem;
        padding: 0.3em 0.8em;
        font-weight: 600;
        display: inline-block;
    }
    .badge-ringan {
        background-color: #28A745 !important; /* Warna Hijau sedikit berbeda dari sehat */
        color: #fff !important;
        font-size: 0.9em;
        border-radius: 1rem;
        padding: 0.3em 0.8em;
        font-weight: 600;
        display: inline-block;
    }
    .badge-sedang {
        background-color: #FFC107 !important; /* Warna Orange */
        color: #fff !important;
        font-size: 0.9em;
        border-radius: 1rem;
        padding: 0.3em 0.8em;
        font-weight: 600;
        display: inline-block;
    }
    .badge-berat {
        background-color: #DC3545 !important; /* Warna Merah */
        color: #fff !important;
        font-size: 0.9em;
        border-radius: 1rem;
        padding: 0.3em 0.8em;
        font-weight: 600;
        display: inline-block;
    }
    @media (max-width: 600px) {
        .card-modern { max-width: 100%; }
        .card-header-modern { font-size: 1.05rem; padding: 1rem 0.5rem 0.5rem 0.5rem; }
    }
    .modal-content {
        border-radius:2rem;
        box-shadow:0 8px 32px 0 rgba(76,169,163,0.15);
        overflow:hidden;
        font-family: 'Poppins', sans-serif;
    }
    .modal-header {
        background: linear-gradient(90deg, #4CA9A3 0%, #A8E6CF 100%);
        color: #fff;
        border-radius: 2rem 2rem 0 0;
        border-bottom: none;
        padding: 1rem 1.5rem;
    }
    .modal-title {
        font-weight: 700;
        font-size: 1.2rem;
    }
    .modal-body {
        background:#fff;
        padding: 1.5rem;
    }
    .form-label.fw-semibold {
        font-weight: 600 !important;
        color: #264653;
        margin-bottom: 0.5rem;
    }
    .form-control-lg {
        border-radius: 1rem;
        font-size: 1rem;
        padding: 0.75rem 1rem;
    }
    .form-select-lg {
        border-radius: 1rem;
        font-size: 1rem;
        padding: 0.75rem 2.5rem 0.75rem 1rem;
    }
    .modal-body .btn-custom {
        padding: 0.75rem 2rem;
        font-size: 1.1rem;
    }
    .modal-body .btn-outline-secondary {
        border-radius: 2rem;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #6c757d;
        border-color: #6c757d;
    }
    .modal-body .btn-outline-secondary:hover {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>
<div class="container">
    <div class="text-center py-5">
        <div class="dashboard-title mb-2">👋 Haloo!!</div>
        <div class="dashboard-subtitle">Selamat datang di <b>Teman Jiwa</b>!</div>
        <div class="alert alert-info shadow-sm mb-4" style="max-width: 400px; margin: 0 auto;">
            <strong>Saldo Anda:</strong>
            <span id="saldo-value">*****</span>
            <button id="toggle-saldo" type="button" class="btn btn-link p-0 ms-2" style="vertical-align:middle; text-decoration:none; color: #264653;">
                <i id="icon-saldo" class="fa-solid fa-eye"></i>
            </button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const saldoValue = document.getElementById('saldo-value');
                const toggleBtn = document.getElementById('toggle-saldo');
                const icon = document.getElementById('icon-saldo');
                let visible = false;
                const saldoAsli = 'Rp {{ number_format($user->saldo, 0, ",", ".") }}';
                toggleBtn.addEventListener('click', function() {
                    visible = !visible;
                    if (visible) {
                        saldoValue.textContent = saldoAsli;
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        saldoValue.textContent = '*****';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        </script>
        <button type="button" class="btn btn-custom btn-lg mb-4" data-bs-toggle="modal" data-bs-target="#topupModal">Top Up Saldo</button>
        <div class="dashboard-section">
            <div class="row justify-content-center mb-4">
                <div class="col-md-12">
                    <div class="card card-modern">
                        <div class="card-header card-header-modern text-center">
                            <span class="dashboard-icon"><i class="fa-solid fa-heart-pulse"></i></span>
                            <div class="monitoring-title">Pemantauan Kesehatan Mental</div>
                        </div>
                        <div class="card-body text-center p-3">
                            @if($lastAssessment)
                                <div class="mb-2 monitoring-info">
                                    <span class="monitoring-label">Penilaian:</span> <span class="monitoring-value">{{ $lastAssessment->assessment->judul ?? '-' }}</span>
                                </div>
                                <div class="mb-2 monitoring-info">
                                    <span class="monitoring-label">Tanggal:</span> <span class="monitoring-value">{{ $lastAssessment->updated_at->format('d-m-Y H:i') }}</span>
                                </div>
                                <div class="mb-2 monitoring-info">
                                    <span class="monitoring-label">Poin:</span> <span class="badge badge-soft shadow-sm">{{ $lastAssessment->skor }}</span>
                                </div>
                                <div class="mb-2 monitoring-info">
                                    <span class="monitoring-label">Kategori:</span>
                                    @if($lastAssessment->kategori == 'Sehat')
                                        <span class="badge badge-sehat shadow-sm">{{ $lastAssessment->kategori }}</span>
                                    @elseif($lastAssessment->kategori == 'Ringan')
                                        <span class="badge badge-ringan shadow-sm">{{ $lastAssessment->kategori }}</span>
                                    @elseif($lastAssessment->kategori == 'Sedang')
                                        <span class="badge badge-sedang shadow-sm">{{ $lastAssessment->kategori }}</span>
                                    @elseif($lastAssessment->kategori == 'Berat')
                                        <span class="badge badge-berat shadow-sm">{{ $lastAssessment->kategori }}</span>
                                    @else
                                        <span class="badge bg-success shadow-sm">{{ $lastAssessment->kategori }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('assessment.result', $lastAssessment->id) }}" class="btn btn-custom mt-3">Lihat Detail</a>
                            @else
                                <div class="text-muted">Belum ada hasil assessment. Silakan lakukan assessment untuk memantau kesehatan mental Anda.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-divider"></div>
    </div>
</div>

<!-- Modal Top Up Saldo -->
<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="topupModalLabel"><i class="fa-solid fa-wallet me-2"></i>Top Up Saldo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('topup') }}" method="POST">
          @csrf
          <div class="mb-4">
            <label for="amount" class="form-label fw-semibold">Jumlah Saldo</label>
            <input type="number" class="form-control form-control-lg" id="amount" name="amount" placeholder="Masukkan jumlah saldo" required>
          </div>
          <div class="mb-4">
            <label for="payment_method" class="form-label fw-semibold">Metode Pembayaran</label>
            <select class="form-select form-select-lg" id="payment_method" name="payment_method" required>
              <option value="bank_transfer">Transfer Bank</option>
              <option value="gopay">Gopay</option>
              <option value="ovo">OVO</option>
              <option value="dana">DANA</option>
            </select>
          </div>
          <div class="d-flex gap-3 justify-content-between align-items-center mt-4">
            <button type="submit" class="btn btn-custom flex-grow-1 py-2">Tambah Saldo</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
