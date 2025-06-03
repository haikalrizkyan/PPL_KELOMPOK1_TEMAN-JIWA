<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - Teman Jiwa</title>
  <link rel="icon" href="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Comfortaa:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background: linear-gradient(135deg, #F4FAF9 0%, #E8F5F4 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .logo {
      display: block;
      margin: 0 auto 20px;
      max-width: 120px;
      transition: transform 0.3s ease;
    }
    .logo:hover {
      transform: scale(1.05);
    }
    .register-container {
      max-width: 400px;
      width: 90%;
      margin: 2rem auto;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 1.5rem;
      box-shadow: 0 8px 32px 0 rgba(76,169,163,0.15);
      padding: 2.5rem 2rem 2rem 2rem;
      backdrop-filter: blur(10px);
      transform: translateY(0);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .register-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px 0 rgba(76,169,163,0.2);
    }
    .btn-temanjiwa {
      background: linear-gradient(135deg, #4CA9A3 0%, #3D8C87 100%);
      color: #fff;
      font-weight: 600;
      border-radius: 2rem;
      border: none;
      transition: all 0.3s ease;
      padding: 0.8rem 1.5rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-family: 'Comfortaa', cursive;
    }
    .btn-temanjiwa:hover {
      background: linear-gradient(135deg, #3D8C87 0%, #2D6C67 100%);
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(76,169,163,0.3);
    }
    .form-label {
      color: #264653;
      font-weight: 500;
      margin-bottom: 0.5rem;
      font-family: 'Comfortaa', cursive;
    }
    .form-control {
      border-radius: 1rem;
      padding: 0.8rem 1.2rem;
      border: 2px solid #E8F5F4;
      transition: all 0.3s ease;
      font-family: 'Quicksand', sans-serif;
    }
    .form-control:focus {
      border-color: #4CA9A3;
      box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
    }
    .register-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #264653;
      text-align: center;
      margin-bottom: 1.5rem;
      position: relative;
      font-family: 'Comfortaa', cursive;
    }
    .register-title::after {
      content: '';
      display: block;
      width: 50px;
      height: 3px;
      background: linear-gradient(135deg, #4CA9A3 0%, #3D8C87 100%);
      margin: 0.5rem auto;
      border-radius: 2px;
    }
    .login-link {
      color: #4CA9A3;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      font-family: 'Comfortaa', cursive;
    }
    .login-link:hover {
      color: #3D8C87;
      text-decoration: none;
    }
    .alert {
      border-radius: 1rem;
      border: none;
      background: rgba(220, 53, 69, 0.1);
      color: #dc3545;
      font-family: 'Quicksand', sans-serif;
    }
    @media (max-width: 576px) {
      .register-container {
        margin: 1rem;
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="register-container animate__animated animate__fadeIn">
    <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Teman Jiwa Logo" class="logo animate__animated animate__fadeInDown">
    <div class="register-title animate__animated animate__fadeInUp">Buat Akun</div>
    @if($errors->any())
      <div class="alert animate__animated animate__shakeX">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="form-group mb-4">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama lengkap Anda">
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-4">
        <label for="email" class="form-label">Alamat Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan alamat email Anda">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-4">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="Buat kata sandi (minimal 8 karakter)">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
      <div class="form-group mb-4">
        <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi kata sandi">
      </div>
      <button type="submit" class="btn btn-temanjiwa btn-block w-100 mb-3">Daftar</button>
      <p class="mt-4 text-center">Sudah punya akun? <a href="{{ route('login') }}" class="login-link">Masuk</a></p>
    </form>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>