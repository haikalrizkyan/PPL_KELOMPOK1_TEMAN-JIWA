@extends('layouts.app')

@section('content')
<style>
    .psikolog-card {
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px 0 rgba(122,195,195,0.10);
        border: none;
        transition: box-shadow 0.2s, transform 0.2s;
        min-height: 350px;
    }
    .psikolog-card:hover {
        box-shadow: 0 8px 32px 0 rgba(122,195,195,0.18);
        transform: translateY(-4px) scale(1.02);
    }
    .psikolog-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #7AC3C3;
        border: 3px solid #7AC3C3;
    }
    .badge-spesialisasi {
        background: #e0f7f7;
        color: #3b7c7c;
        font-size: 0.95em;
        border-radius: 1rem;
        padding: 0.3em 1em;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    .btn-book {
        background: linear-gradient(90deg, #7AC3C3 0%, #a7e3e3 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 0.7rem 0;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px 0 rgba(122,195,195,0.10);
    }
    .btn-book:hover {
        background: linear-gradient(90deg, #a7e3e3 0%, #7AC3C3 100%);
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(122,195,195,0.18);
    }
    .psikolog-info {
        margin: 1rem 0;
        padding: 0.5rem;
        background: #f8fafc;
        border-radius: 0.8rem;
    }
    .psikolog-info p {
        margin-bottom: 0.5rem;
    }
    .psikolog-info strong {
        color: #3b7c7c;
    }
    @media (max-width: 767px) {
        .psikolog-card { min-height: unset; }
    }
</style>
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">Daftar Psikolog</h2>
    <div class="row justify-content-center">
        @forelse($psikologs as $psikolog)
            <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                <div class="card psikolog-card w-100">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <div class="psikolog-avatar mx-auto mb-3">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-2">{{ $psikolog->nama }}</h5>
                            <span class="badge-spesialisasi">{{ $psikolog->spesialisasi }}</span>
                            <div class="psikolog-info">
                                <p><strong>Pengalaman:</strong> {{ $psikolog->pengalaman }} tahun</p>
                                <p><strong>Biaya Konsultasi:</strong> Rp {{ number_format($psikolog->biaya_konsultasi, 0, ',', '.') }}</p>
                            </div>
                            <p class="card-text text-muted small mb-3">{{ $psikolog->deskripsi }}</p>
                        </div>
                        <a href="{{ route('konsultasi.booking.form', $psikolog->id) }}" class="btn btn-book w-100 mt-2">Book Konsultasi</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada psikolog yang tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@if(session('success'))
<!-- Modal Success Booking -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Booking Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
</script>
@endif
@endsection 