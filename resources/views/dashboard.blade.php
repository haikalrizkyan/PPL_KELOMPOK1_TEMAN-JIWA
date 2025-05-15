@extends('layouts.app')

@section('title', 'Home - Teman Jiwa')


@section('content')
<style>
    body {
        background: #f4f6fb;
    }
    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #4f46e5;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }
    .dashboard-subtitle {
        font-size: 1.2rem;
        color: #6b7280;
        margin-bottom: 2rem;
    }
    .dashboard-section {
        margin-bottom: 2.5rem;
    }
    .dashboard-divider {
        border-top: 2px dashed #e0e7ff;
        margin: 2.5rem 0 2rem 0;
    }
    .dashboard-icon {
        font-size: 2.2rem;
        color: #6366f1;
        margin-bottom: 0.5rem;
    }
    .btn-custom {
        background: linear-gradient(90deg, #6366f1 0%, #7c3aed 100%);
        color: #fff;
        border: none;
        border-radius: 2rem;
        font-weight: 600;
        padding: 0.7rem 2.2rem;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 16px 0 rgba(99, 102, 241, 0.12);
    }
    .btn-custom:hover {
        background: linear-gradient(90deg, #7c3aed 0%,rgb(244, 14, 14) 100%);
        color: #fff;
        box-shadow: 0 8px 24px 0 rgba(99, 102, 241, 0.18);
    }
    .card-modern {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
        border: none;
    }
    .card-header-modern {
        background: linear-gradient(90deg,rgb(247, 12, 12) 0%, #7c3aed 100%);
        color: #fff;
        font-size: 1.3rem;
        font-weight: 700;
        border-radius: 1.5rem 1.5rem 0 0;
        letter-spacing: 1px;
        border: none;
    }
    .badge-soft {
        background: #e0e7ff;
        color: #3730a3;
        font-size: 1.1em;
        border-radius: 1rem;
        padding: 0.5em 1.2em;
        font-weight: 600;
    }
</style>
<div class="container">
    <div class="text-center py-5">
        <div class="dashboard-title mb-2">👋 Haloo!!</div>
        <div class="dashboard-subtitle">Selamat datang di <b>Teman Jiwa</b>!</div>
        <div class="alert alert-info shadow-sm mb-4" style="max-width: 400px; margin: 0 auto;">
            <strong>Saldo Anda:</strong>
            <span id="saldo-value">*****</span>
            <button id="toggle-saldo" type="button" class="btn btn-link p-0 ms-2" style="vertical-align:middle; text-decoration:none;">
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
        <button type="button" class="btn btn-custom btn-lg mb-4" style="font-size:1.2rem; min-width:220px;" data-bs-toggle="modal" data-bs-target="#topupModal">Top Up Saldo</button>
        <div class="dashboard-section">
            <div class="row justify-content-center mb-4">
                <div class="col-md-7">
                    <div class="card card-modern">
                        <div class="card-header card-header-modern text-center">
                            <span class="dashboard-icon"><i class="fa-solid fa-heart-pulse"></i></span><br>
                            Monitoring Mental Health
                        </div>
                        <div class="card-body text-center p-4">
                            @if($lastAssessment)
                                <div class="mb-3">
                                    <span class="fw-semibold text-secondary">Assessment:</span> <span class="text-dark">{{ $lastAssessment->assessment->judul ?? '-' }}</span>
                                </div>
                                <div class="mb-3">
                                    <span class="fw-semibold text-secondary">Tanggal:</span> <span class="text-dark">{{ $lastAssessment->updated_at->format('d-m-Y H:i') }}</span>
                                </div>
                                <div class="mb-3">
                                    <span class="fw-semibold text-secondary">Skor:</span> <span class="badge badge-soft shadow-sm">{{ $lastAssessment->skor }}</span>
                                </div>
                                <div class="mb-3">
                                    <span class="fw-semibold text-secondary">Kategori:</span> <span class="badge bg-success fs-5 px-3 py-2 shadow-sm" style="border-radius:1rem; font-size:1.1em">{{ $lastAssessment->kategori }}</span>
                                </div>
                                <a href="{{ route('assessment.result', $lastAssessment->id) }}" class="btn btn-custom mt-2">Lihat Detail</a>
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
    <div class="modal-content" style="border-radius:2rem; box-shadow:0 8px 32px 0 rgba(99,102,241,0.15); overflow:hidden;">
      <div class="modal-header" style="background: linear-gradient(90deg, #6366f1 0%, #7c3aed 100%); color: #fff; border-radius: 2rem 2rem 0 0; border-bottom: none;">
        <h5 class="modal-title fw-bold" id="topupModalLabel"><i class="fa-solid fa-wallet me-2"></i>Top Up Saldo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4" style="background:#fff;">
        <form action="{{ route('topup') }}" method="POST">
          @csrf
          <div class="mb-4">
            <label for="amount" class="form-label fw-semibold">Jumlah Saldo</label>
            <input type="number" class="form-control form-control-lg" id="amount" name="amount" placeholder="Masukkan jumlah saldo" required style="border-radius:1rem;">
          </div>
          <div class="mb-4">
            <label for="payment_method" class="form-label fw-semibold">Metode Pembayaran</label>
            <select class="form-select form-select-lg" id="payment_method" name="payment_method" required style="border-radius:1rem;">
              <option value="bank_transfer">Transfer Bank</option>
              <option value="gopay">Gopay</option>
              <option value="ovo">OVO</option>
              <option value="dana">DANA</option>
            </select>
          </div>
          <div class="d-flex gap-3 justify-content-between align-items-center mt-4">
            <button type="submit" class="btn btn-custom flex-grow-1 py-2" style="font-size:1.1rem; border-radius:2rem;">Top Up</button>
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
