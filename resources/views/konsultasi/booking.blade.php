@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        border: none !important;
        padding: 1.5rem !important; /* Consistent padding */
    }
    .card-header {
        background-color: #fff;
        color: #264653;
        font-weight: 700;
        font-size: 1.2rem; /* Slightly reduced font size for header */
        border-bottom: none;
        padding: 1rem 1.5rem !important; /* Adjusted padding */
        margin-bottom: 1rem !important;
        text-align: center;
        border-radius: 1.5rem 1.5rem 0 0 !important;
    }
    .form-label {
        color: #264653;
        font-weight: 500;
        margin-bottom: 0.5rem; /* Added margin-bottom */
    }
    .form-control:focus {
        border-color: #4CA9A3;
        box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
    }
    /* Teman Jiwa Button Style */
    .btn-temanjiwa {
        background: #4CA9A3;
        color: #fff;
        font-weight: 600;
        border-radius: 2rem;
        border: none;
        transition: background 0.2s;
        padding: 0.75rem 1.5rem; /* Adjusted padding */
        font-size: 1.1rem; /* Adjusted font size */
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        color: #fff;
    }
    /* Specific styles for booking page */
    .booking-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.8rem; /* Kept main header font size */
        margin-bottom: 0.5rem;
    }
     .booking-subheader {
        color: #264653;
        margin-bottom: 2.5rem; /* Increased bottom margin */
        font-size: 1.1rem; /* Adjusted font size */
     }
    .balance-info h5 {
        color: #264653;
        font-weight: 500;
        font-size: 1rem; /* Adjusted font size */
        margin-bottom: 0.25rem; /* Reduced bottom margin */
    }
    .balance-info h3 {
         font-weight: 700;
         font-size: 1.5rem; /* Adjusted font size */
    }
    .alert-danger, .alert-warning, .alert-info {
        border-radius: 1rem;
        font-size: 1rem; /* Kept font size */
        border: none;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1.5rem; /* Consistent margin */
    }
    .alert-info {
        background: #e3f8fa;
        color: #264653;
    }
     .alert-warning {
        background: #fff3cd;
        color: #664d03;
    }
    .badge.bg-danger {
        background-color: #dc3545 !important;
        border-radius: 0.5rem !important;
        padding: 0.3em 0.6em !important;
        font-weight: 600 !important;
    }
    .form-check-label {
        color: #264653;
        font-weight: normal;
        cursor: pointer;
        margin-bottom: 0.5rem;
        font-size: 1rem; /* Adjusted font size */
    }
    .form-check-label:hover {
    }
     .form-check-input:checked ~ .form-check-label {
        font-weight: 600;
     }
     .form-check-input:checked {
     }
     .form-check input[type="radio"] {
     }
    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.25); /* Keep the default focus ring for accessibility */
    }
    /* Add styles to prevent size change on focus/active */
    .form-check input[type="radio"]:focus ~ .form-check-label {
        transform: none; /* Prevent any scaling on focus */
    }
    .form-check input[type="radio"]:active ~ .form-check-label {
        transform: none; /* Prevent any scaling on active */
    }

    /* Specific override for checked state on active */
    .form-check input[type="radio"]:checked:active ~ .form-check-label {
    }
    .text-success {
         color: #28a745 !important;
    }
     .text-danger {
         color: #dc3545 !important;
     }
    .card-header h6 {
        font-weight: 600;
        margin-bottom: 0; /* Remove default margin bottom */
    }
     .form-check {
        padding-left: 1.5em; /* Increased padding for radio button */
        margin-bottom: 0.5rem; /* Added margin bottom */
     }
     .form-check-input {
        margin-top: 0.3em;
        margin-left: -1.5em; /* Align radio button */
     }
     .form-check-label {
        margin-bottom: 0;
        padding-left: 0.5em; /* Added padding for label */
     }
     /* Removed grid related styles */
     /* .card-body .row.g-2 { */
     /*    margin-left: -0.5rem; */
     /*    margin-right: -0.5rem; */
     /* } */
     /* .card-body .row.g-2 > .col-md-3, .card-body .row.g-2 > .col-sm-6 { */
     /*     padding-left: 0.5rem; */
     /*     padding-right: 0.5rem; */
     /*     margin-bottom: 1rem; */
     /* } */
     /* Specific style for disabled form check label */
     .form-check input[disabled] ~ label {
         cursor: not-allowed;
         opacity: 0.7;
         font-weight: normal;
         box-shadow: none;
     }
      .form-check input[disabled] ~ label .badge {
          background-color: #6c757d !important;
      }

      /* Further general refinements */
      .container.py-5 {
          padding-top: 3rem !important;
          padding-bottom: 3rem !important;
      }
      .text-center.mb-5 {
          margin-bottom: 3rem !important; /* Increase space below header */
      }
      .card.shadow-lg.rounded-4 {
          margin-bottom: 2rem !important; /* Consistent margin below cards */
      }
      .card-body.p-4 {
          padding: 1.5rem !important; /* Ensure consistent card body padding */
      }
      .card-body > .mb-4:last-child {
          margin-bottom: 0 !important; /* Remove bottom margin from the last mb-4 element in card body */
      }
      .alert {
          margin-bottom: 1.5rem !important; /* Consistent margin below alerts */
    }
</style>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="booking-header">Pemesanan Konsultasi ke Psikolog</h2>
        <p class="booking-subheader">Bersama <strong>{{ $psychologist->nama }}</strong></p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger text-center" style="max-width: 600px; margin: 0 auto 2rem auto;">
            <ul class="mb-0" style="list-style: none; padding: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg rounded-4 mb-4">
                <div class="card-body p-4 balance-info">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="mb-1">Biaya Konsultasi</h5>
                            <h3 class="text-temanjiwa mb-0">Rp {{ number_format($psychologist->biaya_konsultasi, 0, ',', '.') }}</h3>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-1">Saldo Anda</h5>
                            <h3 class="{{ Auth::user()->saldo >= $psychologist->biaya_konsultasi ? 'text-success' : 'text-danger' }} mb-0">
                                Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                    @if(Auth::user()->saldo < $psychologist->biaya_konsultasi)
                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Saldo Anda tidak cukup untuk melakukan booking. 
                            <a href="{{ route('dashboard') }}" class="alert-link" style="color: #664d03; font-weight: 600;">Top up saldo</a> terlebih dahulu.
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-lg rounded-4">
                <div class="card-header">Pilih Jadwal Konsultasi</div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('konsultasi.booking.store', $psychologist->id) }}" id="bookingForm">
                        @csrf

                        <div class="mb-4">
                            @forelse($availableSchedules as $tanggal => $schedules)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0" style="color: #264653;">{{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach($schedules as $schedule)
                                            @php
                                                $isBooked = $existingBookings->contains(function($booking) use ($tanggal, $schedule) {
                                                    return $booking->tanggal == $tanggal && $booking->jam == \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i');
                                                });
                                            @endphp
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio"
                                                    name="jam" id="jam_{{ $schedule->id }}"
                                                    value="{{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }}"
                                                    {{ $isBooked ? 'disabled' : '' }}
                                                    required>
                                                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                                <label class="form-check-label {{ $isBooked ? 'text-muted' : '' }}" for="jam_{{ $schedule->id }}">
                                                    {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}
                                                    @if($isBooked)
                                                        <span class="badge bg-danger ms-1">Sudah Dipesan</span>
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Belum ada jadwal yang tersedia untuk 7 hari ke depan.
                                </div>
                            @endforelse
                        </div>

                        <div class="mb-4">
                            <label for="catatan" class="form-label fw-semibold">📝 Catatan (Opsional)</label>
                            <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror"
                                rows="3" placeholder="Contoh: Saya ingin membahas tentang kecemasan...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-temanjiwa btn-lg rounded-pill"
                                {{ Auth::user()->saldo < $psychologist->biaya_konsultasi || $availableSchedules->isEmpty() ? 'disabled' : '' }}>
                                Pesan Sekarang 🚀
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4 text-muted small">
                Butuh bantuan? Hubungi kami melalui <a href="#" style="color: #4CA9A3; font-weight: 600;">pusat bantuan</a>.
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('bookingForm');
        // Updated to select all radio buttons within a card body to handle multiple date cards
        const dateCards = form.querySelectorAll('.card');

        dateCards.forEach(card => {
            const radioButtons = card.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                        // Update the hidden tanggal input in the main form with the selected date
                        const selectedDateInput = this.closest('.card-body').querySelector('input[name="tanggal"]');
                        form.querySelector('input[name="tanggal"]').value = selectedDateInput.value;
                }
                });
            });
        });
    });
</script>
@endpush
@endsection