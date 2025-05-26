@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important; /* Ensure consistent background */
    }
    .psikolog-card {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
        border: none;
        transition: box-shadow 0.2s, transform 0.2s;
        min-height: 350px;
        background: #fff;
    }
    .psikolog-card:hover {
        box-shadow: 0 12px 36px 0 rgba(76,169,163,0.18);
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
        color: #4CA9A3;
        border: 3px solid #4CA9A3;
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
        background: #4CA9A3;
        color: #fff;
        border: none;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 0.7rem 0;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px 0 rgba(76,169,163,0.10);
    }
    .btn-book:hover {
        background: #3D8C87;
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(76,169,163,0.18);
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
    .psikolog-name {
        font-size: 1.2rem; /* Consistent font size with article titles */
        font-weight: 700; /* Ensure bold */
    }
</style>
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center" style="color:#264653; font-size: 1.5rem;">Daftar Psikologi</h2>
    <div class="row justify-content-center">
        @forelse($psikologs as $psikolog)
            <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                <div class="card psikolog-card w-100">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            @if($psikolog->foto_profil)
                                <img src="{{ asset('storage/' . $psikolog->foto_profil) }}" class="psikolog-avatar mx-auto mb-3" alt="Psychologist Photo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #4CA9A3;">
                            @else
                                <div class="psikolog-avatar mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #4CA9A3;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            @endif
                            <h5 class="card-title psikolog-name mb-2">{{ $psikolog->nama }}</h5>
                            <span class="badge-spesialisasi">{{ $psikolog->spesialisasi }}</span>
                            <div class="psikolog-info">
                                <p><strong>Pengalaman:</strong> {{ $psikolog->pengalaman }} tahun</p>
                                <p><strong>Harga Konsultasi:</strong> Rp {{ number_format($psikolog->biaya_konsultasi, 0, ',', '.') }}</p>
                            </div>
                            <p class="card-text text-muted small mt-2 mb-3">{{ $psikolog->deskripsi }}</p>
                        </div>
                        <a href="{{ route('konsultasi.booking.form', $psikolog->id) }}" class="btn btn-book w-100 mt-2">Konsultasi Sekarang</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Tidak ada psikolog yang tersedia saat ini.</div>
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
                <h5 class="modal-title" id="successModalLabel">Pemesanan Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
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