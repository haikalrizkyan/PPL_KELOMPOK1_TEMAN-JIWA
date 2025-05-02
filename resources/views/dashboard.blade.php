@extends('layouts.app')

@section('title', 'Home - Teman Jiwa')


@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="text-center py-4">
                <h2 class="mb-4">Haloo!!</h2>
                <p class="text-muted">Selamat datang, {{ $user->name }}!</p>

                @if(!is_null($lastAssessment))
                <!-- Monitoring Mental Health Section -->
                <div class="alert alert-success mb-4 p-4 shadow rounded-4" style="background: #e6f9f0;">
                    <strong style="font-size: 1.2rem;">Monitoring Mental Health:</strong><br>
                    <span>Skor Assessment Terakhir: <b style="font-size: 1.1rem;">{{ optional($lastAssessment)->score }}</b></span><br>
                    <span>Hasil: <b style="font-size: 1.1rem;">{{ optional($lastAssessment)->result }}</b></span>
                </div>
                @endif

                <!-- Recent Activity Section -->
                <div class="mb-4 recent-activity-bg p-4 rounded-4 shadow-sm">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="fs-4 text-primary"><i class="fas fa-history"></i></span>
                        <h5 class="mb-0" style="font-weight: bold; letter-spacing: 1px;">Recent Activity</h5>
                    </div>
                    @if($recentActivities->count() > 0)
                        <div class="recent-activity-list">
                        @foreach($recentActivities as $activity)
                            @if(isset($activity->activity_type) && $activity->activity_type === 'assessment')
                                <div class="activity-card d-flex align-items-center mb-3 p-3 rounded-4 shadow-sm" style="background: #fff; animation: fadeInUp 0.7s cubic-bezier(.39,.575,.56,1.000);">
                                    <div class="me-3 text-center" style="min-width:56px;">
                                        <div class="bg-primary text-white rounded-3 px-2 py-1 mb-1" style="font-size:0.95rem;">
                                            <i class="fas fa-calendar-alt me-1"></i><br>{{ \Carbon\Carbon::parse($activity->created_at)->format('d M') }}<br><span style="font-size:0.85em;">{{ \Carbon\Carbon::parse($activity->created_at)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold mb-1" style="font-size:1.1rem;">Skor: <span class="text-primary">{{ $activity->score }}</span></div>
                                        <div>
                                            <span class="badge {{ $activity->result == 'Tidak ada indikasi gangguan mental' ? 'bg-success' : ($activity->result == 'Indikasi gangguan ringan' ? 'bg-info text-dark' : ($activity->result == 'Indikasi gangguan sedang' ? 'bg-warning text-dark' : 'bg-danger')) }} px-3 py-2" style="font-size:1em;">
                                                <i class="fas fa-brain me-1"></i>{{ $activity->result }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @elseif(isset($activity->activity_type) && $activity->activity_type === 'topup')
                                <div class="activity-card d-flex align-items-center mb-3 p-3 rounded-4 shadow-sm" style="background: #e6f9f0; animation: fadeInUp 0.7s cubic-bezier(.39,.575,.56,1.000);">
                                    <div class="me-3 text-center" style="min-width:56px;">
                                        <div class="bg-success text-white rounded-3 px-2 py-1 mb-1" style="font-size:0.95rem;">
                                            <i class="fas fa-money-bill-wave me-1"></i><br>{{ \Carbon\Carbon::parse($activity->created_at)->format('d M') }}<br><span style="font-size:0.85em;">{{ \Carbon\Carbon::parse($activity->created_at)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold mb-1" style="font-size:1.1rem; color:#198754;">+Rp {{ number_format($activity->amount, 0, ',', '.') }}</div>
                                        <div>
                                            <span class="badge bg-success px-3 py-2" style="font-size:1em;"><i class="fas fa-wallet me-1"></i>Top Up Saldo</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    @else
                        <div class="text-muted">Belum ada aktivitas assessment atau top up.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button for Top Up + Label -->
<div class="fab-topup-container">
  <button type="button" class="btn btn-primary btn-lg rounded-circle shadow fab-topup" data-bs-toggle="modal" data-bs-target="#topupModal" title="Top Up Saldo">
      <i class="fas fa-plus"></i>
  </button>
  <span class="fab-topup-label">TOP UP</span>
</div>

<!-- Modal Top Up Saldo -->
<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="topupModalLabel">Top Up Saldo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Top Up</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  .fab-topup-container {
    position: fixed;
    bottom: 32px;
    right: 32px;
    z-index: 1055;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  .fab-topup-label {
    background: #fff;
    color: #0d6efd;
    font-weight: 700;
    border-radius: 1rem;
    padding: 0.5rem 1.1rem;
    box-shadow: 0 2px 8px 0 rgba(13,110,253,0.08);
    font-size: 1.1rem;
    letter-spacing: 1px;
    border: 2px solid #0d6efd;
    transition: background 0.2s, color 0.2s;
  }
  .fab-topup-container:hover .fab-topup-label {
    background: #0d6efd;
    color: #fff;
  }
  .fab-topup {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    background: linear-gradient(90deg, #0d6efd 60%, #0dcaf0 100%);
    border: none;
    transition: box-shadow 0.2s, background 0.2s;
  }
  .fab-topup:hover {
    box-shadow: 0 6px 24px 0 rgba(13,110,253,0.18);
    background: linear-gradient(90deg, #0dcaf0 60%, #0d6efd 100%);
  }
  @media (max-width: 768px) {
    .fab-topup-container {
      bottom: 20px;
      right: 20px;
      gap: 0.5rem;
    }
    .fab-topup {
      width: 56px;
      height: 56px;
      font-size: 1.5rem;
    }
    .fab-topup-label {
      font-size: 1rem;
      padding: 0.4rem 0.8rem;
    }
  }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .recent-activity-bg {
    background: #f4f8fb;
    border-radius: 1.5rem;
    padding: 2rem 1.5rem;
  }
  .activity-card {
    transition: box-shadow 0.2s;
    background: #fff !important;
    border-radius: 1.2rem;
  }
  .activity-card:hover {
    box-shadow: 0 6px 24px 0 rgba(13,110,253,0.13);
    background: #eaf6ff !important;
  }
  .question-card {
    background: #fff;
    border: 1.5px solid #f0f0f0;
    box-shadow: 0 4px 16px 0 rgba(13,110,253,0.07);
    transition: box-shadow 0.2s;
  }
  .question-card:hover {
    box-shadow: 0 8px 32px 0 rgba(13,110,253,0.13);
  }
  .question-number {
    background: #0d6efd;
    color: #fff;
    font-weight: bold;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
  }
  .custom-radio {
    position: relative;
    display: flex;
    align-items: center;
    cursor: pointer;
    margin-right: 1.5rem;
  }
  .custom-radio input[type=\"radio\"] {
    display: none;
  }
  .radio-label {
    padding: 0.5rem 1.2rem;
    border-radius: 2rem;
    background: #f4f8fb;
    color: #222;
    font-weight: 500;
    transition: background 0.2s, color 0.2s;
    border: 2px solid transparent;
  }
  .custom-radio input[type=\"radio\"]:checked + .radio-label {
    background: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
  }
  .radio-label.tidak-pernah { background: #e9ecef; color: #198754; }
  .radio-label.jarang { background: #e0f7fa; color: #0dcaf0; }
  .radio-label.kadang-kadang { background: #fff3cd; color: #ffc107; }
  .radio-label.sering { background: #ffe5e5; color: #fd7e14; }
  .radio-label.sangat-sering { background: #f8d7da; color: #dc3545; }
  .custom-radio input[type=\"radio\"]:checked + .radio-label.tidak-pernah { background: #198754; color: #fff; }
  .custom-radio input[type=\"radio\"]:checked + .radio-label.jarang { background: #0dcaf0; color: #fff; }
  .custom-radio input[type=\"radio\"]:checked + .radio-label.kadang-kadang { background: #ffc107; color: #fff; }
  .custom-radio input[type=\"radio\"]:checked + .radio-label.sering { background: #fd7e14; color: #fff; }
  .custom-radio input[type=\"radio\"]:checked + .radio-label.sangat-sering { background: #dc3545; color: #fff; }
</style>
@endsection


