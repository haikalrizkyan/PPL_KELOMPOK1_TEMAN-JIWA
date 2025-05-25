<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atur ulang kata sandi - Teman Jiwa</title>
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
    .reset-container {
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
    .reset-title {
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
  <div class="reset-container">
    <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Teman Jiwa Logo" class="logo">
    <div class="reset-title">Atur ulang kata sandi</div>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="POST" action="">
      @csrf
      <div class="form-group mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="password" class="form-label">Kata Sandi Baru</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter new password">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm new password">
      </div>
      <button type="submit" class="btn btn-temanjiwa btn-block w-100 mb-2">Atur Ulang Kata Sandi</button>
      <p class="mt-3 text-center">
        <a href="{{ url()->previous() }}" class="login-link">Kembali</a>
      </p>
    </form>
  </div>
</body>
</html> 