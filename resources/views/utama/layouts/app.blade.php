<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'SMK Taman Siswa Purwokerto - Sekolah Menengah Kejuruan Berkualitas dengan Program Keahlian Unggulan')">
    <meta name="author" content="SMK Taman Siswa Purwokerto">
    <meta name="keywords" content="@yield('meta_keywords', 'SMK, Taman Siswa, Purwokerto, Pendidikan, Kejuruan, Layanan Perbankan, Usaha Layanan Wisata, Perhotelan')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="@yield('og_title', 'SMK Taman Siswa Purwokerto')">
    <meta property="og:description" content="@yield('og_description', 'SMK Taman Siswa Purwokerto - Sekolah Menengah Kejuruan Berkualitas')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <title>@yield('title', 'SMK Taman Siswa Purwokerto - Modern & Berkarakter')</title>
    
    {{-- Modern CSS from blade-template --}}
    <link rel="stylesheet" href="{{ asset('css/modern-style.css') }}">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Ekko Lightbox CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ekko-lightbox@5.3.0/dist/ekko-lightbox.css">
    
    {{-- AOS (Animate On Scroll) CSS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    {{-- Additional CSS --}}
    @stack('styles')
    
    {{-- Additional styling for btn-modern --}}
    <style>
        .btn-modern {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-modern.btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-modern.btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-modern.btn-outline {
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
        }
        .btn-modern.btn-outline:hover {
            background: #667eea;
            color: white;
        }
        .section {
            padding: 4rem 0;
        }
        /* Scroll-to-top button */
        #scrollTopBtn {
            position: fixed;
            right: 1.5rem;
            bottom: 1.5rem;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #667eea;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(102,126,234,0.25);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: opacity .25s ease, transform .25s ease, visibility .25s;
            z-index: 9999;
            border: none;
        }
        #scrollTopBtn.show { opacity: 1; visibility: visible; transform: translateY(0); }
        #scrollTopBtn:focus { outline: none; box-shadow: 0 0 0 4px rgba(102,126,234,0.12); }
    </style>

</head>
<body>
    
    {{-- Navbar --}}
    @include('utama.layouts.navbar')
    
    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>
    
    {{-- Footer --}}
    @include('utama.layouts.footer')
    
    {{-- Scroll to top button --}}
    <button id="scrollTopBtn" class="btn-modern" aria-label="Scroll to top" title="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    {{-- jQuery (required for ekko-lightbox) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    {{-- Bootstrap JS (if not already included) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Ekko Lightbox --}}
    <script src="https://cdn.jsdelivr.net/npm/ekko-lightbox@5.3.0/dist/ekko-lightbox.min.js"></script>
    
    {{-- AOS (Animate On Scroll) JS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    {{-- JavaScript --}}
    <script src="{{ asset('js/modern-script.js') }}"></script>
    
    {{-- Initialize AOS --}}
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false,
            offset: 100
        });
    </script>
    
    {{-- Scroll-to-top behaviour --}}
    <script>
        (function(){
            const btn = document.getElementById('scrollTopBtn');
            if (!btn) return;
            const offset = 300; // px scrolled before showing
            const toggle = () => {
                if (window.scrollY > offset) btn.classList.add('show');
                else btn.classList.remove('show');
            };
            window.addEventListener('scroll', toggle, { passive: true });
            // initialize state
            toggle();
            btn.addEventListener('click', function(){
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            // keyboard support
            btn.addEventListener('keyup', function(e){ if (e.key === 'Enter' || e.key === ' ') btn.click(); });
        })();
    </script>
    {{-- Additional JS --}}
    @stack('scripts')

</body>
</html>