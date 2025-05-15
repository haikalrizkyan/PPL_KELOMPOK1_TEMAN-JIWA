@extends('layouts.app')

@section('content')
<style>
    .psikolog-card {
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px 0 rgba(99,102,241,0.10);
        border: none;
        transition: box-shadow 0.2s, transform 0.2s;
        min-height: 350px;
    }
    .psikolog-card:hover {
        box-shadow: 0 8px 32px 0 rgba(99,102,241,0.18);
        transform: translateY(-4px) scale(1.02);
    }
    .psikolog-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #6366f1;
    }
    .badge-spesialisasi {
        background: #e0e7ff;
        color: #3730a3;
        font-size: 0.95em;
        border-radius: 1rem;
        padding: 0.3em 1em;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    .btn-book {
        background: linear-gradient(90deg, #6366f1 0%, #7c3aed 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 0.7rem 0;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px 0 rgba(99,102,241,0.10);
    }
    .btn-book:hover {
        background: linear-gradient(90deg, #7c3aed 0%, #6366f1 100%);
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(99,102,241,0.18);
    }
    @media (max-width: 767px) {
        .psikolog-card { min-height: unset; }
    }
</style>
<div class="container">
    <h2 class="mb-4 fw-bold text-center">Daftar Psikolog</h2>
    <div class="row justify-content-center">
        @forelse($psikologs as $psikolog)
            <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                <div class="card psikolog-card w-100">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div class="psikolog-avatar mb-2"><i class="fa-solid fa-user"></i></div>
                        <h5 class="card-title fw-bold mb-1">{{ $psikolog->nama }}</h5>
                        <span class="badge-spesialisasi">{{ $psikolog->spesialisasi }}</span>
                        <p class="card-text mb-1"><strong>Pengalaman:</strong> {{ $psikolog->pengalaman }} tahun</p>
                        <p class="card-text mb-1"><strong>Biaya Konsultasi:</strong> Rp {{ number_format($psikolog->biaya_konsultasi, 0, ',', '.') }}</p>
                        <p class="card-text text-muted small">{{ $psikolog->deskripsi }}</p>
                        <a href="{{ route('konsultasi.booking.form', $psikolog->id) }}" class="btn btn-book w-100 mt-2">Book Konsultasi</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada psikolog yang tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@if(session('success'))
<!-- Modal Success Booking -->
<div class="modal fade" id="successBookingModal" tabindex="-1" aria-labelledby="successBookingLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:1.5rem;">
      <div class="modal-header bg-success text-white" style="border-radius:1.5rem 1.5rem 0 0;">
        <h5 class="modal-title" id="successBookingLabel"><i class="fa-solid fa-circle-check me-2"></i>Booking Berhasil!</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">{{ session('success') }}</p>
      </div>
    </div>
  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('successBookingModal'));
        modal.show();
    });
</script>
@endif
@endsection 