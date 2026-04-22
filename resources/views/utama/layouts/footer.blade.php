{{-- Modern Footer --}}
<footer>
    <div class="container mobile:text-sm">
        <div class="footer-grid">
            {{-- About Section --}}
            <div class="footer-col">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SMK Tamansiswa" style="height: 60px; width: auto;">
                    <h4 class="mobile:text-lg font-bold" style="margin-bottom: 0;">SMK TAMAN SISWA PURWOKERTO</h4>
                </div>
                <p style="color: white;">Sekolah kejuruan unggulan yang berdedikasi menciptakan lulusan siap kerja, cerdas, dan berkarakter.</p>
                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <a href="https://www.instagram.com/smktamansiswapurwokerto" target="_blank" style="font-size: 1.2rem; color: white;"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@smktamansiswapurwokerto9" target="_blank" style="font-size: 1.2rem; color: white;"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.facebook.com/smktamansiswa.purwokerto" target="_blank" style="font-size: 1.2rem; color: white;"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.youtube.com/@smktamansiswapurwokerto2809" target="_blank" style="font-size: 1.2rem; color: white;"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h4>Tautan Cepat</h4>
                <ul>
                    <li><a href="{{ route('profilsekolah.profile') }}">Profil Sekolah</a></li>
                    <li><a href="{{ route('jurusan.index') }}">Program Keahlian</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route('event.index') }}">Event</a></li>
                    <li><a href="{{ route('galeri.index') }}">Galeri</a></li>
                    <li><a href="{{ route('profilsekolah.ppdb-detail') }}">Info PPDB</a></li>
                    <li><a href="{{ route('tic.index') }}">Tourism Information Center</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="footer-col">
                <h4>Hubungi Kami</h4>
                <ul>
                    <li><i class="fas fa-map-marker-alt" style="width: 20px;"></i> Jl. Sunan Ampel, Dusun IV, Kedungmalang, Kec. Sumbang, Kabupaten Banyumas, Jawa Tengah 53183</li>
                    <li><i class="fas fa-phone" style="width: 20px;"></i> (0281) 6510348</li>
                    <li><i class="fas fa-envelope" style="width: 20px;"></i> smktamansiswapurwokerto@gmail.com</li>
                    <li><i class="fab fa-whatsapp" style="width: 20px;"></i> +62 813-2887-7238</li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; {{ date('Y') }} SMK Taman Siswa Purwokerto. All Rights Reserved.</p>
        </div>
    </div>
</footer>