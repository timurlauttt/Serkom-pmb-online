@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview statistik dan aktivitas terbaru')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        @if(auth()->user()->role === 'admin')
        <!-- Berita Card -->
        <div class="card-hover bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Berita</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['berita'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-newspaper text-blue-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.beritas.index') }}" class="mt-4 text-blue-600 text-sm font-medium hover:underline inline-flex items-center">
                Lihat semua <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
        
        <!-- Event Card -->
        <div class="card-hover bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Event</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['event'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-purple-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.events.index') }}" class="mt-4 text-purple-600 text-sm font-medium hover:underline inline-flex items-center">
                Lihat semua <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
        
        <!-- Pengumuman Card -->
        <div class="card-hover bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pengumuman</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['pengumuman'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-bullhorn text-green-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.pengumumans.index') }}" class="mt-4 text-green-600 text-sm font-medium hover:underline inline-flex items-center">
                Lihat semua <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
        
        <!-- Galeri Card -->
        <div class="card-hover bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Galeri</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['galeri'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-images text-yellow-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.galeris.index') }}" class="mt-4 text-yellow-600 text-sm font-medium hover:underline inline-flex items-center">
                Lihat semua <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
        @endif
        
        <!-- Pendaftaran Card -->
        <div class="card-hover bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pendaftaran</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['pendaftaran'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-user-plus text-red-600 text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.pendaftaran.index') }}" class="mt-4 text-red-600 text-sm font-medium hover:underline inline-flex items-center">
                Lihat semua <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>
    
    @if(auth()->user()->role === 'admin')
    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Berita -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Berita Terbaru</h3>
                <a href="{{ route('admin.beritas.index') }}" class="text-blue-600 text-sm font-medium hover:underline">Lihat semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentBerita as $berita)
                    <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-gray-800 truncate">{{ $berita->judul }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $berita->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">Belum ada berita</p>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Events -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Event Terbaru</h3>
                <a href="{{ route('admin.events.index') }}" class="text-purple-600 text-sm font-medium hover:underline">Lihat semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentEvents as $event)
                    <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                            @if($event->gambar)
                                <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-gray-800 truncate">{{ $event->judul }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $event->tanggal }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">Belum ada event</p>
                @endforelse
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
