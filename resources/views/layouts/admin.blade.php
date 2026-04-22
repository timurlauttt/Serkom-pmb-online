<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - SMK Taman Siswa</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        #sidebar {
            transform: translateX(-100%);
        }

        #sidebar.show {
            transform: translateX(0);
        }

        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-xl flex flex-col transition-all duration-300 fixed lg:relative z-40 h-full">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-800 text-lg">SMK Taman Siswa</h1>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-6 px-3">
                <div class="space-y-4">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.dashboard') ? 'active text-white' : '' }}">
                        <i class="fas fa-home w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Info Sekolah Section -->
                    @if(auth()->user()->role === 'admin')
                    <div>
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Info Sekolah</p>
                        <div class="space-y-1">
                            <a href="{{ route('admin.profiles.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.profiles.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-school w-5 text-sm"></i>
                                <span class="text-sm font-medium">Profil</span>
                            </a>
                            <a href="{{ route('admin.jurusans.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.jurusans.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-book-open w-5 text-sm"></i>
                                <span class="text-sm font-medium">Jurusan</span>
                            </a>
                            <a href="{{route('admin.ekstrakurikulers.index')}}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.ekstrakurikulers.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-running w-5 text-sm"></i>
                                <span class="text-sm font-medium">Ekstrakurikuler</span>
                            </a>
                            <a href="{{route('admin.prestasis.index')}}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.prestasis.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-trophy w-5 text-sm"></i>
                                <span class="text-sm font-medium">Prestasi</span>
                            </a>
                            <a href="{{ route('admin.mitras.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.mitras.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-handshake w-5 text-sm"></i>
                                <span class="text-sm font-medium">Mitra</span>
                            </a>
                        </div>
                    </div>

                    <!-- Informasi Section -->
                    <div>
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Informasi</p>
                        <div class="space-y-1">
                            <a href="{{ route('admin.beritas.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.beritas.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-newspaper w-5 text-sm"></i>
                                <span class="text-sm font-medium">Berita</span>
                            </a>
                            <a href="{{ route('admin.events.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.events.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-calendar-alt w-5 text-sm"></i>
                                <span class="text-sm font-medium">Event</span>
                            </a>
                            <a href="{{ route('admin.pengumumans.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.pengumumans.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-bullhorn w-5 text-sm"></i>
                                <span class="text-sm font-medium">Pengumuman</span>
                            </a>
                            <a href="{{ route('admin.galeris.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.galeris.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-images w-5 text-sm"></i>
                                <span class="text-sm font-medium">Galeri</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- PPDB Section -->
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'adminPPDB')
                    <div>
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">PPDB</p>
                        <div class="space-y-1">
                            <a href="{{ route('admin.pendaftaran.calon-siswa') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.pendaftaran.calon-siswa') ? 'active text-white' : '' }}">
                                <i class="fas fa-users w-5 text-sm"></i>
                                <span class="text-sm font-medium">Calon Siswa</span>
                            </a>
                            <a href="{{ route('admin.pendaftaran.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.pendaftaran.index*') ? 'active text-white' : '' }}">
                                <i class="fas fa-user-plus w-5 text-sm"></i>
                                <span class="text-sm font-medium">Pendaftaran</span>
                            </a>
                            <a href="{{route('admin.ppdb_brosurs.index')}}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.ppdb_brosurs.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-file-pdf w-5 text-sm"></i>
                                <span class="text-sm font-medium">Brosur</span>
                            </a>
                            <a href="{{route('admin.ppdb_jalurs.index')}}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.ppdb_jalurs.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-road w-5 text-sm"></i>
                                <span class="text-sm font-medium">Jalur</span>
                            </a>
                            <a href="{{route('admin.ppdb_links.index')}}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.ppdb_links.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-link w-5 text-sm"></i>
                                <span class="text-sm font-medium">Link</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- TIC Section -->
                    @if(auth()->user()->role === 'admin')
                    <div>
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">TIC</p>
                        <div class="space-y-1">
                            <a href="{{ route('admin.hotels.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.hotels.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-hotel w-5 text-sm"></i>
                                <span class="text-sm font-medium">Hotel</span>
                            </a>
                            <a href="{{ route('admin.objek-wisata.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.objek-wisata.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-map-marked-alt w-5 text-sm"></i>
                                <span class="text-sm font-medium">Objek Wisata</span>
                            </a>
                            <a href="{{ route('admin.desa-wisata.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.desa-wisata.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-tree w-5 text-sm"></i>
                                <span class="text-sm font-medium">Desa Wisata</span>
                            </a>
                            <a href="{{ route('admin.paket-wisata.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.paket-wisata.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-suitcase w-5 text-sm"></i>
                                <span class="text-sm font-medium">Paket Wisata</span>
                            </a>
                            <a href="{{ route('admin.restorans.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.restorans.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-utensils w-5 text-sm"></i>
                                <span class="text-sm font-medium">Restoran</span>
                            </a>
                            <a href="{{ route('admin.transportasi.index') }}" class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('admin.transportasi.*') ? 'active text-white' : '' }}">
                                <i class="fas fa-bus w-5 text-sm"></i>
                                <span class="text-sm font-medium">Transportasi</span>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-100">
                <div class="flex items-center space-x-3 px-3 py-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Admin PPDB' }}</p>
                    </div>
                    <a href="{{ route('logout') }}" class="text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-800">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-500">@yield('page-description', 'Selamat datang di admin panel')</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all text-sm font-medium">
                            <i class="fas fa-external-link-alt mr-2"></i>Lihat Website
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 py-4 px-6">
                <div class="flex flex-col sm:flex-row items-center justify-between text-sm text-gray-600">
                    <p>&copy; {{ date('Y') }} SMK Taman Siswa. All rights reserved.</p>
                    <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                        <a href="#" class="hover:text-blue-600 transition-colors">Bantuan</a>
                        <span class="text-gray-300">|</span>
                        <a href="#" class="hover:text-blue-600 transition-colors">Dokumentasi</a>
                        <span class="text-gray-300">|</span>
                        <a href="#" class="hover:text-blue-600 transition-colors">Kontak Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay?.addEventListener('click', () => {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.add('hidden');
        });
    </script>

    <!-- jQuery (required for Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    @stack('scripts')
</body>

</html>