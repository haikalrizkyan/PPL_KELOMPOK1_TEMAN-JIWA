<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Teman Jiwa</title>
  <link rel="icon" href="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Ubuntu', sans-serif;
      background-color: #f8f9fa;
    }
    .logo {
      display: block;
      margin: 0 auto 20px;
      max-width: 250px;
    }
    .container {
      max-width: 500px;
      margin-top: 5rem;
    }
    .btn-success {
      background-color: #5fbdc2;
      border-color: #5fbdc2;
    }
    .btn-success:hover {
      background-color: #4aa995;
      border-color: #4aa995;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <!-- Logo -->
    <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Teman Jiwa Logo" class="logo">

    <h2 class="text-center mb-4">Create Your Account</h2>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter full name">
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="Create password (min 8 characters)">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
      </div>

      <button type="submit" class="btn btn-success btn-block">Register</button>
      <p class="mt-3 text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </form>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>