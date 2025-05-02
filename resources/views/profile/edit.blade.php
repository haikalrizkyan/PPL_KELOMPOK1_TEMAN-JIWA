@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<style>
    .profile-card {
        box-shadow: 0 4px 24px 0 rgba(0,0,0,0.08), 0 1.5px 4px 0 rgba(0,0,0,0.03);
        border-radius: 1.5rem;
        padding: 2.5rem 2rem 2rem 2rem;
        background: #fff;
    }
    .profile-avatar {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #e9ecef;
        margin-bottom: 0.5rem;
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.07);
    }
    .profile-divider {
        border-top: 1px solid #e9ecef;
        margin: 1.5rem 0 1.5rem 0;
    }
    .profile-label {
        font-weight: 500;
        color: #222;
    }
    .btn-save {
        background: linear-gradient(90deg, #0d6efd 60%, #0dcaf0 100%);
        color: #fff;
        font-weight: 600;
        border: none;
        transition: box-shadow 0.2s;
        box-shadow: 0 2px 8px 0 rgba(13,110,253,0.08);
    }
    .btn-save:hover {
        box-shadow: 0 4px 16px 0 rgba(13,110,253,0.18);
        color: #fff;
    }
</style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="profile-card mx-auto">
                <div class="text-center mb-2">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="profile-avatar">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff" alt="Avatar" class="profile-avatar">
                    @endif
                    <div class="fw-bold mt-2" style="font-size:1.2rem;">{{ $user->name }}</div>
                    <div class="mt-2 mb-2">
                        <div class="alert alert-info text-center p-2 mb-0" style="font-size:1.1rem; border-radius: 1rem; display: inline-block; min-width: 180px;">
                            <strong>Total Saldo:</strong> Rp {{ number_format($user->saldo, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="profile-divider"></div>
                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="photo" class="form-label profile-label">Foto Profil</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        @error('photo')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label profile-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label profile-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label profile-label">No. Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-save px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 