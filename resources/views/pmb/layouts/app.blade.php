
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'Dashboard Siswa PPDB') - SMK Taman Siswa</title>

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<style>
		body { font-family: 'Inter', sans-serif; }
		.sidebar-link { transition: all 0.3s ease; }
		.sidebar-link:hover { transform: translateX(5px); }
		.sidebar-link.active { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; }
		#sidebar { transform: translateX(-100%); }
		#sidebar.show { transform: translateX(0); }
		@media (min-width: 1024px) { #sidebar { transform: translateX(0); } }
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
					<div class="w-10 h-10 bg-linear-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
						<i class="fas fa-graduation-cap text-white text-lg"></i>
					</div>
					<div>
						<h1 class="font-bold text-gray-800 text-lg">SMK Taman Siswa</h1>
						<p class="text-xs text-gray-500">PPDB Siswa</p>
					</div>
				</div>
			</div>

			<!-- Navigation -->
			<nav class="flex-1 overflow-y-auto py-6 px-3">
				<div class="space-y-4">
					<!-- Dashboard -->
					<a href="{{ route('pmb.dashboard') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('pmb.dashboard') ? 'active' : '' }}">
						<i class="fas fa-home w-5"></i>
						<span class="font-medium">Dashboard</span>
					</a>

					<!-- Data Diri -->
					<a href="{{ route('pmb.dashboard.data-diri') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('pmb.dashboard.data-diri') ? 'active' : '' }}">
						<i class="fas fa-user w-5"></i>
						<span class="font-medium">Data Diri</span>
					</a>

					<!-- Status Pendaftaran -->
					<a href="{{ route('pmb.dashboard.status-pendaftaran') }}" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 {{ request()->routeIs('pmb.dashboard.status-pendaftaran') ? 'active' : '' }}">
						<i class="fas fa-info-circle w-5"></i>
						<span class="font-medium">Status Pendaftaran</span>
					</a>

					<!-- Logout -->
					<a href="{{ route('pmb.logout') }}" id="logoutLink" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50">
						<i class="fas fa-sign-out-alt w-5"></i>
						<span class="font-medium">Logout</span>
					</a>
				</div>
			</nav>

		</aside>

		<!-- Main Content -->
		<div class="flex-1 flex flex-col overflow-hidden">
			<!-- Header -->
			<header class="bg-white shadow-sm z-10">
				<div class="flex items-center justify-between px-6 py-4">
					<div class="flex items-center space-x-4">
						<button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-800">
							<i class="fas fa-bars"></i>
						</button>
						<div>
							<span class="font-semibold text-lg text-gray-700">@yield('title', 'Dashboard Siswa PPDB')</span>
						</div>
					</div>
					<div class="flex items-center space-x-4">
						<a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-linear-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all text-sm font-medium">
							Lihat Website
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
			const logoutLink = document.getElementById('logoutLink');

		sidebarToggle?.addEventListener('click', () => {
			sidebar.classList.toggle('show');
			sidebarOverlay.classList.toggle('hidden');
		});

		sidebarOverlay?.addEventListener('click', () => {
			sidebar.classList.remove('show');
			sidebarOverlay.classList.add('hidden');
		});

			logoutLink?.addEventListener('click', (event) => {
				event.preventDefault();

				Swal.fire({
					title: 'Logout?',
					text: 'Apakah kamu yakin ingin logout dari akun ini?',
					icon: 'question',
					showCancelButton: true,
					confirmButtonText: 'Ya',
					cancelButtonText: 'Tidak',
					confirmButtonColor: '#2563eb',
					cancelButtonColor: '#6b7280',
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = logoutLink.href;
					}
				});
			});
	</script>
	@stack('scripts')
</body>
</html>
