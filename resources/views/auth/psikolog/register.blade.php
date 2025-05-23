<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Psychologist Register - Teman Jiwa</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Ubuntu', sans-serif;
      background-color: #F4FAF9;
    }
    .logo {
      display: block;
      margin: 0 auto 20px;
      max-width: 120px;
    }
    .register-container {
      max-width: 400px;
      margin: 4rem auto;
      background: #fff;
      border-radius: 1.5rem;
      box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
      padding: 2.5rem 2rem 2rem 2rem;
    }
    .btn-temanjiwa {
      background: #4CA9A3;
      color: #fff;
      font-weight: 600;
      border-radius: 2rem;
      border: none;
      transition: background 0.2s;
    }
    .btn-temanjiwa:hover {
      background: #3D8C87;
      color: #fff;
    }
    .form-label {
      color: #264653;
      font-weight: 500;
    }
    .form-control:focus {
      border-color: #4CA9A3;
      box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
    }
    .register-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #264653;
      text-align: center;
      margin-bottom: 1.5rem;
    }
    .login-link {
      color: #4CA9A3;
      text-decoration: underline;
    }
    .login-link:hover {
      color: #3D8C87;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Teman Jiwa Logo" class="logo">
    <div class="register-title">Create Psychologist Account</div>
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('psikolog.register.submit') }}">
      @csrf
      <div class="form-group mb-3">
        <label for="nama" class="form-label">Full Name</label>
        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Enter your full name">
        @error('nama')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create password (min 8 characters)">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="password-confirm" class="form-label">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
      </div>
      <div class="form-group mb-3">
        <label for="nomor_lisensi" class="form-label">License Number</label>
        <input id="nomor_lisensi" type="text" class="form-control @error('nomor_lisensi') is-invalid @enderror" name="nomor_lisensi" value="{{ old('nomor_lisensi') }}" required placeholder="Enter your license number">
        @error('nomor_lisensi')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="spesialisasi" class="form-label">Specialization</label>
        <input id="spesialisasi" type="text" class="form-control @error('spesialisasi') is-invalid @enderror" name="spesialisasi" value="{{ old('spesialisasi') }}" required placeholder="Enter your specialization">
        @error('spesialisasi')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="pengalaman" class="form-label">Experience (years)</label>
        <input id="pengalaman" type="number" class="form-control @error('pengalaman') is-invalid @enderror" name="pengalaman" value="{{ old('pengalaman') }}" required placeholder="Enter your experience in years">
        @error('pengalaman')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="biaya_konsultasi" class="form-label">Consultation Fee</label>
        <input id="biaya_konsultasi" type="number" class="form-control @error('biaya_konsultasi') is-invalid @enderror" name="biaya_konsultasi" value="{{ old('biaya_konsultasi') }}" required placeholder="Enter your consultation fee">
        @error('biaya_konsultasi')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="deskripsi" class="form-label">Description</label>
        <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4" placeholder="Describe yourself, your approach, etc.">{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <button type="submit" class="btn btn-temanjiwa btn-block w-100 mb-2">Register</button>
      <p class="mt-3 text-center">Already have an account? <a href="{{ route('psikolog.login') }}" class="login-link">Login here</a></p>
    </form>
  </div>
</body>
</html> 