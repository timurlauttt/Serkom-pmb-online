{{-- Modern Navbar --}}
<header>
    <div class="container">
        <nav>
            <a href="{{ route('landingpage') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SMK Tamansiswa" style="height: 50px; width: auto;">
                <div style="display: flex; flex-direction: column; line-height: 1.2;">
                    <span style="font-size: 0.95rem; font-weight: 600; color: white;">SMK Tamansiswa</span>
                    <span style="font-size: 0.95rem; font-weight: 600; color: white;">Purwokerto</span>
                </div>
            </a>
            <div class="mobile-toggle" id="mobile-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links" id="nav-links">
                
                {{-- Tentang Kami --}}
                <li><a href="{{ route('profilsekolah.profile') }}" class="{{ Request::routeIs('profilsekolah.profile') ? 'active' : '' }}">Tentang Kami</a></li>
                
                {{-- Jurusan (Dynamic from DB) --}}
                <li class="dropdown">
                    <a href="#" class="{{ Request::routeIs('jurusan.*') ? 'active' : '' }}">Jurusan <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        @php
                            $jurusans = \App\Models\Jurusan::orderBy('name')->get();
                        @endphp
                        
                        @forelse($jurusans as $jurusan)
                            <li><a href="{{ route('jurusan.show', $jurusan->slug) }}">{{ $jurusan->name }}</a></li>
                        @empty
                            <li><a href="{{ route('jurusan.index') }}">Semua Jurusan</a></li>
                        @endforelse
                    </ul>
                </li>
                
                {{-- Kesiswaan --}}
                <li class="dropdown">
                    <a href="#" class="{{ Request::routeIs('kesiswaan.*') ? 'active' : '' }}">Kesiswaan <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profilsekolah.ekstrakulikuler') }}">Ekstrakulikuler</a></li>
                        <li><a href="{{ route('profilsekolah.prestasi') }}">Prestasi</a></li>
                    </ul>
                </li>
                

                {{-- Informasi --}}
                <li class="dropdown">
                    <a href="#" class="{{ Request::routeIs('berita.*') || Request::routeIs('event.*') || Request::routeIs('pengumuman.*') ? 'active' : '' }}">Informasi <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li><a href="{{ route('event.index') }}">Event</a></li>
                        <li><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
                    </ul>
                </li>
                {{-- PPDB --}}
                <li><a href="{{ route('profilsekolah.ppdb-detail') }}" class="{{ Request::routeIs('profilsekolah.ppdb*') ? 'active' : '' }}">PPDB</a></li>
                
                
                {{-- Galeri --}}
                <li><a href="{{ route('galeri.index') }}" class="{{ Request::routeIs('galeri.*') ? 'active' : '' }}">Galeri</a></li>
                
                {{-- TIC --}}
                <li><a href="{{ route('tic.index') }}" class="{{ Request::routeIs('tic.*') ? 'active' : '' }}">TIC</a></li>
            </ul>
        </nav>
    </div>
</header>