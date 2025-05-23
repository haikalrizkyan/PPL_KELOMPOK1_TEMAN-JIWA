<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Teman Jiwa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" type="image/x-icon">
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #F4FAF9;
        }
        .welcome-container {
            max-width: 400px;
            margin: 4rem auto;
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
            padding: 2.5rem 2rem 2rem 2rem;
            text-align: center;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 120px;
        }
        .welcome-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #264653;
            margin-bottom: 1rem;
        }
        .welcome-subtitle {
            color: #264653;
            margin-bottom: 2rem;
        }
        .btn-outline-temanjiwa {
            border: 2px solid #4CA9A3;
            color: #4CA9A3;
            font-weight: 600;
            border-radius: 2rem;
            background: #fff;
            margin-bottom: 1rem;
            transition: background 0.2s, color 0.2s;
        }
        .btn-outline-temanjiwa:hover {
            background: #4CA9A3;
            color: #fff;
        }
        .policy-text {
            font-size: 0.9rem;
            color: #888;
            margin-top: 1rem;
        }
        .policy-text a {
            color: #4CA9A3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <img src="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" alt="Teman Jiwa Logo" class="logo">
        <div class="welcome-title">Welcome</div>
        <div class="welcome-subtitle">Start by signing in or creating a new account</div>
        <a href="{{ route('login') }}" class="btn btn-outline-temanjiwa btn-block">Sign In as User</a>
        <a href="{{ route('psikolog.login') }}" class="btn btn-outline-temanjiwa btn-block">Sign In as Psychologist</a>
        <a href="{{ route('register') }}" class="btn btn-outline-temanjiwa btn-block">Register as User</a>
        <a href="{{ route('psikolog.register') }}" class="btn btn-outline-temanjiwa btn-block">Register as Psychologist</a>
        <div class="policy-text">
            By continuing, you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.
        </div>
    </div>
</body>
</html>