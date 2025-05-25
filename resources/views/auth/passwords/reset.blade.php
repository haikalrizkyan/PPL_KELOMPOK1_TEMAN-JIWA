<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Teman Jiwa</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/temanjiwa.css') }}">
  <style>
    body {
      font-family: 'Ubuntu', sans-serif;
      background-color: #F4FAF9;
    }
    .article-form-container {
      max-width: 430px;
      margin: 4rem auto;
      background: #fff;
      border-radius: 1.5rem;
      box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
      padding: 2.5rem 2rem 2rem 2rem;
    }
    .logo {
      display: block;
      margin: 0 auto 20px;
      max-width: 120px;
    }
    .form-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #264653;
      text-align: center;
      margin-bottom: 1.5rem;
      font-family: 'Ubuntu', sans-serif;
    }
    .form-label {
      color: #264653;
      font-weight: 500;
      font-family: 'Ubuntu', sans-serif;
    }
    .form-group {
      margin-bottom: 1.3rem;
    }
    .form-control, .form-control-file {
      border-radius: 1rem;
      font-family: 'Ubuntu', sans-serif;
      border: 1.5px solid #E6F4F1;
      background: #F8FCFB;
      font-size: 1rem;
    }
    .form-control:focus {
      border-color: #4CA9A3;
      box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
    }
    .form-control::placeholder {
      color: #A0B0B9;
      opacity: 1;
      font-style: italic;
    }
    .btn-temanjiwa {
      background: #4CA9A3;
      color: #fff;
      font-weight: 600;
      border-radius: 2rem;
      border: none;
      transition: background 0.2s;
      font-family: 'Ubuntu', sans-serif;
      font-size: 1.1rem;
      padding: 0.7rem 0;
    }
    .btn-temanjiwa:hover {
      background: #3D8C87;
      color: #fff;
    }
    .form-text.text-muted {
      color: #7B8A8B !important;
      font-size: 0.95rem;
    }
    @media (max-width: 600px) {
      .article-form-container {
        padding: 1.2rem 0.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="article-form-container">
    <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Teman Jiwa Logo" class="logo">
    <div class="form-title">Reset Your Password</div>
    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="form-group mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="password" class="form-label">New Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter new password">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="password-confirm" class="form-label">Confirm New Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm new password">
      </div>
      <button type="submit" class="btn btn-temanjiwa btn-block mt-3">Reset Password</button>
    </form>
    @if (request('role') === 'psychologist')
        <a href="{{ route('psikolog.login') }}" class="login-link d-block text-center mt-2">Back</a>
    @else
        <a href="{{ route('login') }}" class="login-link d-block text-center mt-2">Back</a>
    @endif
  </div>
</body>
</html>
