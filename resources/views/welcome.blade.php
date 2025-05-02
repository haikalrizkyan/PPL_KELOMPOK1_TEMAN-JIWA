<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg') }}" type="image/x-icon">
    <style>
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }
        .btn-outline {
            transition: all 0.3s ease;
        }
        .btn-outline:hover {
            background-color: rgba(79, 70, 229, 0.05);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <img src="WhatsApp Image 2025-03-28 at 21.17.58_adbf7a26.jpg" alt="Logo" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
            <p class="text-gray-600">Mulai dengan masuk atau buat akun baru</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-8">
            @if (Route::has('login'))
                @auth
                    <div class="flex flex-col space-y-4">
                        <a href="{{ url('/dashboard') }}" class="btn-primary text-white py-3 px-6 rounded-lg font-medium text-center flex items-center justify-center">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="btn-outline border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium text-center flex items-center justify-center w-full">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-col space-y-4">
                        <a href="{{ route('login') }}" class="btn-primary text-white py-3 px-6 rounded-lg font-medium text-center flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </a>
                        
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-outline border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium text-center flex items-center justify-center">
                                <i class="fas fa-user-plus mr-2"></i> Daftar
                            </a>
                        @endif
                    </div>
                @endauth
            @endif
            
            <div class="mt-6 text-center">
                <p class="text-gray-500 text-sm">Dengan melanjutkan, Anda menyetujui <a href="#" class="text-indigo-600 hover:underline">Syarat</a> dan <a href="#" class="text-indigo-600 hover:underline">Kebijakan Privasi</a> kami.</p>
            </div>
        </div>
    </div>
</body>
</html>