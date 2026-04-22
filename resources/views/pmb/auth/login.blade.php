<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login PPDB SMK Tamansiswa Purwokerto</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Left Panel - Blue Background */
        .left-panel {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(255,255,255,0.1) 100%);
            transform: rotate(45deg);
        }

        .building-image {
            background: linear-gradient(rgba(30, 58, 138, 0.6), rgba(30, 58, 138, 0.6)), 
                        url('{{ asset('images/bg-login.jpg') }}') no-repeat center center;
            background-size: cover;
            opacity: 0.4;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
        }

        /* Brand Text */
        .brand-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px 50px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .brand-text {
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: -1px;
        }

        /* Right Panel - Form */
        .right-panel {
            background: #f5f5f5;
        }

        /* Input Focus */
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        /* Button Hover */
        .btn-primary:hover {
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .brand-text {
                font-size: 2rem;
            }
            .brand-box {
                padding: 20px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="flex min-h-screen">
        <!-- Left Panel - Branding -->
        <div class="left-panel hidden lg:flex lg:w-1/2 items-center justify-center p-12 relative">
            <div class="building-image"></div>
            <div class="relative z-10">
                <div class="brand-box">
                    <h1 class="brand-text">
                        <span class="text-gray-800 font-black">Login PPDB</span> 
                        <span class="text-blue-600 font-light">SMK Tamansiswa Purwokerto</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Right Panel - Form -->
        <div class="right-panel w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Logo & Title -->
                <div class="text-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SMK" class="mx-auto w-28 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">PPDB SMK Tamansiswa Purwokerto</h2>
                    <p class="text-sm text-gray-500 mt-2">Silakan masuk untuk melanjutkan</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle mt-0.5 mr-2"></i>
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Form Login -->
                <form action="{{ route('pendaftaran.siswa.login') }}" method="post" id="loginForm" autocomplete="off" novalidate>
                    @csrf
                    <div class="mb-5">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="username" name="username" placeholder="email" required
                            class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none transition-all">
                        <span id="loginEmailError" class="text-xs text-red-500 hidden">Format email tidak sesuai</span>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Password" required
                                   class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none transition-all pr-12">
                            <span onclick="togglePassword()"
                                class="absolute inset-y-0 right-4 flex items-center cursor-pointer text-gray-400 hover:text-blue-600 transition-colors">
                                <i id="eye-icon" class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn-primary w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        MASUK
                    </button>
                </form>

                <div class="flex justify-between items-center mt-5">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('pendaftaran.siswa.register') }}" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">Daftar</a>
                    </p>
                    <p class="text-sm text-gray-600">
                        <a href="{{ route('landingpage') }}" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">kembali ke halaman utama</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.className = 'fas fa-eye';
            } else {
                passwordField.type = 'password';
                eyeIcon.className = 'fas fa-eye-slash';
            }
        }

        // Validasi email login
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('username');
            const emailError = document.getElementById('loginEmailError');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                emailError.classList.remove('hidden');
                e.preventDefault();
            } else {
                emailError.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
