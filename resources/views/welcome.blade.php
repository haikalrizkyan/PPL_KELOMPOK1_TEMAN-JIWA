<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Teman Jiwa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background: linear-gradient(135deg, #F4FAF9 0%, #E8F5F4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-container {
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
        .welcome-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(76,169,163,0.2);
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
        .welcome-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #264653;
            margin-bottom: 1rem;
            position: relative;
        }
        .welcome-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #4CA9A3 0%, #3D8C87 100%);
            margin: 0.5rem auto;
            border-radius: 2px;
        }
        .welcome-subtitle {
            color: #264653;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        .btn-outline-temanjiwa {
            border: 2px solid #4CA9A3;
            color: #4CA9A3;
            font-weight: 600;
            border-radius: 2rem;
            background: #fff;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            padding: 0.8rem 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-outline-temanjiwa:hover {
            background: linear-gradient(135deg, #4CA9A3 0%, #3D8C87 100%);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76,169,163,0.3);
        }
        .policy-text {
            font-size: 0.9rem;
            color: #666;
            margin-top: 1.5rem;
            line-height: 1.5;
        }
        .policy-text a {
            color: #4CA9A3;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .policy-text a:hover {
            color: #3D8C87;
            text-decoration: none;
        }
        @media (max-width: 576px) {
            .welcome-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container animate__animated animate__fadeIn">
        <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Teman Jiwa Logo" class="logo animate__animated animate__fadeInDown">
        <div class="text-center">
    <div class="welcome-title animate__animated animate__fadeInUp">Selamat Datang</div>
    <div class="welcome-subtitle animate__animated animate__fadeInUp animate__delay-1s">
        Mulailah dengan masuk atau membuat akun baru
    </div>
</div>

        <!-- Dropdown MASUK -->
        <div class="dropdown mb-3">
  <button class="btn btn-outline-temanjiwa btn-block dropdown-toggle" type="button" id="dropdownMasuk" data-bs-toggle="dropdown" aria-expanded="false">
    MASUK
  </button>
  <div class="dropdown-menu w-100 p-0 border-0 shadow" aria-labelledby="dropdownMasuk">
    <a href="{{ route('login') }}" class="btn btn-outline-temanjiwa btn-block rounded-0" style="border-top: none;">Masuk sebagai Pengguna</a>
    <a href="{{ route('psikolog.login') }}" class="btn btn-outline-temanjiwa btn-block rounded-0">Masuk sebagai Psikolog</a>
  </div>
</div>

<!-- Dropdown DAFTAR -->
<div class="dropdown mb-3">
  <button class="btn btn-outline-temanjiwa btn-block dropdown-toggle" type="button" id="dropdownDaftar" data-bs-toggle="dropdown" aria-expanded="false">
    DAFTAR
  </button>
  <div class="dropdown-menu w-100 p-0 border-0 shadow" aria-labelledby="dropdownDaftar">
    <a href="{{ route('register') }}" class="btn btn-outline-temanjiwa btn-block rounded-0" style="border-top: none;">Daftar sebagai Pengguna</a>
    <a href="{{ route('psikolog.register') }}" class="btn btn-outline-temanjiwa btn-block rounded-0">Daftar sebagai Psikolog</a>
  </div>
</div>

        <div class="policy-text animate__animated animate__fadeIn animate__delay-2s">
            Dengan melanjutkan, Anda menyetujui ketentuan kami <a href="#">Terms</a> and <a href="#">Kebijakan Privasi</a>.
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>