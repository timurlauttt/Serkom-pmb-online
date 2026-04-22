@extends('utama.layouts.app')
@section('title', 'Prestasi - SMK Taman Siswa Purwokerto')

@section('content')
<section class="section-padding" style="margin-top: 80px;">
    <div class="container">
        <h1 class="section-title">Prestasi Siswa</h1>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">
            Bangga dengan prestasi gemilang siswa-siswi SMK Taman Siswa Purwokerto
        </p>
        {{-- Prestasi Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
            @forelse($prestasis as $prestasi)
            <div style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s; height: 100%;" class="prestasi-card">
                @if($prestasi->is_featured)
                    <div style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: white; text-align: center; padding: 0.5rem; font-weight: 600; font-size: 0.875rem;">
                        <i class="fas fa-star"></i> Prestasi Unggulan
                    </div>
                @endif
                
                <div style="height: 200px; position: relative; overflow: hidden;">
                    @if($prestasi->thumbnail)
                        <img src="{{ asset($prestasi->thumbnail) }}" alt="{{ $prestasi->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-center; 
                            background: {{ $prestasi->tingkat === 'internasional' ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '' }}
                            {{ $prestasi->tingkat === 'nasional' ? 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)' : '' }}
                            {{ $prestasi->tingkat === 'provinsi' ? 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)' : '' }}
                            {{ $prestasi->tingkat === 'kota' ? 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)' : '' }}
                            {{ $prestasi->tingkat === 'sekolah' ? 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)' : '' }};">
                            <i class="fas fa-trophy" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                        </div>
                    @endif
                </div>

                <div style="padding: 1.5rem;">
                    <div style="display: flex; justify-between; align-items: start; margin-bottom: 1rem;">
                        <span style="padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 600;
                            {{ $prestasi->tingkat === 'internasional' ? 'background: #ede9fe; color: #6b21a8;' : '' }}
                            {{ $prestasi->tingkat === 'nasional' ? 'background: #fee2e2; color: #991b1b;' : '' }}
                            {{ $prestasi->tingkat === 'provinsi' ? 'background: #fef3c7; color: #92400e;' : '' }}
                            {{ $prestasi->tingkat === 'kota' ? 'background: #d1fae5; color: #065f46;' : '' }}
                            {{ $prestasi->tingkat === 'sekolah' ? 'background: #dbeafe; color: #1e40af;' : '' }}">
                            {{ ucfirst($prestasi->tingkat) }}
                        </span>
                        <span style="color: #6b7280; font-size: 0.875rem;">{{ $prestasi->tahun }}</span>
                    </div>

                    <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.75rem; color: #111827;">{{ $prestasi->judul }}</h3>
                    
                    @if($prestasi->peringkat)
                        <p style="color: #2563eb; font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-medal"></i> {{ $prestasi->peringkat }}
                        </p>
                    @endif

                    <p style="color: #6b7280; font-size: 0.875rem; line-height: 1.5; margin-bottom: 1rem;">
                        {{ Str::limit($prestasi->deskripsi, 120) }}
                    </p>

                    @if($prestasi->nama_siswa)
                        <div style="padding: 0.75rem; background: #f9fafb; border-radius: 0.5rem; margin-bottom: 0.75rem;">
                            <p style="font-size: 0.875rem; color: #374151;"><i class="fas fa-user-graduate mr-1"></i> {{ $prestasi->nama_siswa }}</p>
                            @if($prestasi->penyelenggara)
                                <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;"><i class="fas fa-building mr-1"></i> {{ $prestasi->penyelenggara }}</p>
                            @endif
                        </div>
                    @endif

                    @if($prestasi->jurusan)
                        <span style="display: inline-block; padding: 0.25rem 0.75rem; background: #eef2ff; color: #4338ca; border-radius: 1rem; font-size: 0.75rem;">
                            {{ $prestasi->jurusan->name }}
                        </span>
                    @endif
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 0;">
                <i class="fas fa-trophy" style="font-size: 5rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                <h3 style="font-size: 1.25rem; color: #6b7280; margin-bottom: 0.5rem;">Belum Ada Prestasi</h3>
                <p style="color: #9ca3af;">Saat ini belum ada data prestasi yang tersedia</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($prestasis->hasPages())
            <div style="margin-top: 3rem; display: flex; justify-content: center;">
                {{ $prestasis->links() }}
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .prestasi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush
@endsection
