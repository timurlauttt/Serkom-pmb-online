<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register PPDB SMK Tamansiswa Purwokerto</title>
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
            overflow-y: hidden;
        }

        html,
        body {
            height: 100%;
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
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 50%, rgba(255, 255, 255, 0.1) 100%);
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
            font-size: 2.3rem;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
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
    <div class="flex h-screen overflow-hidden">
        <!-- Left Panel - Branding -->
        <div class="left-panel hidden lg:flex lg:w-1/2 items-center justify-center p-8 relative">
            <div class="building-image"></div>
            <div class="relative z-10">
                <div class="brand-box py-5 px-8">
                    <h1 class="brand-text">
                        <span class="text-gray-800 font-black">Register PPDB</span>
                        <span class="text-blue-600 font-light">SMK Tamansiswa Purwokerto</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Right Panel - Form -->
        <div class="right-panel w-full lg:w-1/2 flex items-center justify-center p-4 lg:p-6 h-screen overflow-hidden">
            <div class="w-full max-w-md">
                <!-- Logo & Title -->
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SMK" class="mx-auto w-20 mb-3">
                    <h2 class="text-xl font-bold text-gray-800 mb-1">SMK Taman Siswa Purwokerto</h2>
                    <p class="text-xs text-gray-500 mt-1">Buat Akun PPDB</p>
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

                <!-- Form Register -->
                <form action="#" method="post" id="registerForm" autocomplete="off" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap </label>
                        <input type="text" id="username" name="username" placeholder="Username" required
                            class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none transition-all">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" required
                            class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none transition-all">
                        <span id="emailError" class="text-xs text-red-500 hidden">Format email tidak sesuai</span>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" placeholder="Nomor Telepon" required
                            pattern="[0-9]+"
                            class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none transition-all">
                        <span id="phoneError" class="text-xs text-red-500 hidden">Nomor HP harus berupa angka</span>
                    </div>

                    <div class="mb-3">
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

                    <div class="mb-3">
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Konfirmasi Password" required
                                class="input-field block w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:outline-none transition-all pr-12">
                            <span onclick="togglePassword()"
                                class="absolute inset-y-0 right-4 flex items-center cursor-pointer text-gray-400 hover:text-blue-600 transition-colors">
                                <i id="eye-icon" class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn-primary w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        DAFTAR
                    </button>
                </form>

                <p class="mt-3 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('pendaftaran.siswa.login') }}"
                        class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">Masuk</a>
                </p>

                <!-- Mobile Branding disembunyikan agar layout tetap fit satu layar -->
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

        // Validasi email, nomor HP, dan password confirmation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let valid = true;
            // Email
            const email = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value)) {
                emailError.classList.remove('hidden');
                valid = false;
            } else {
                emailError.classList.add('hidden');
            }
            // Nomor HP
            const phone = document.getElementById('phone');
            const phoneError = document.getElementById('phoneError');
            if (!/^\d+$/.test(phone.value)) {
                phoneError.classList.remove('hidden');
                valid = false;
            } else {
                phoneError.classList.add('hidden');
            }
            // Password confirmation
            const password = document.getElementById('password');
            const password_confirmation = document.getElementById('password_confirmation');
            const passwordMatchError = document.getElementById('passwordMatchError');
            if (password.value !== password_confirmation.value) {
                passwordMatchError.classList.remove('hidden');
                valid = false;
            } else {
                passwordMatchError.classList.add('hidden');
            }
            if (!valid) e.preventDefault();
        });
    </script>
</body>

</html>
