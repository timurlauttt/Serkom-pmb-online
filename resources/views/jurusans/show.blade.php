@extends('layouts.admin')

@section('title', 'Detail Jurusan')
@section('page-title', 'Detail Jurusan')
@section('page-description', 'Informasi lengkap jurusan')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Image Header -->
        <div class="h-64 bg-gradient-to-br from-indigo-500 to-purple-600 relative overflow-hidden flex items-center justify-center gap-4">
            @foreach([$jurusan->photo_path, $jurusan->photo_path_2, $jurusan->photo_path_3] as $img)
                @if($img)
                    <img src="{{ asset($img) }}" alt="{{ $jurusan->name }}" class="h-48 w-48 object-contain bg-white rounded-lg shadow border p-2">
                @endif
            @endforeach
            @if(!$jurusan->photo_path && !$jurusan->photo_path_2 && !$jurusan->photo_path_3)
                <div class="flex-1 flex items-center justify-center">
                    <i class="fas fa-book-open text-white text-6xl opacity-50"></i>
                </div>
            @endif
        </div>

        <div class="p-8 space-y-6">
            <!-- Header Info -->
            <div class="pb-6 border-b border-gray-100">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $jurusan->name }}</h1>
                <p class="text-sm text-gray-400 font-mono">Slug: {{ $jurusan->slug }}</p>
            </div>

            <!-- Description -->
            <div>
                <label class="text-sm font-medium text-gray-500 mb-2 block">Deskripsi</label>
                <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $jurusan->description }}
                </div>
            </div>

            <!-- Mata Pelajaran -->
            @if($jurusan->subjects)
                <div>
                    <label class="text-sm font-medium text-gray-500 mb-3 block">Mata Pelajaran</label>
                    <div class="flex flex-wrap gap-2">
                        @if(is_array($jurusan->subjects))
                            @foreach($jurusan->subjects as $subject)
                                <span class="px-4 py-2 bg-indigo-100 text-indigo-800 text-sm font-medium rounded-lg">
                                    <i class="fas fa-book mr-2"></i>{{ $subject }}
                                </span>
                            @endforeach
                        @else
                            @foreach(explode(',', $jurusan->subjects) as $subject)
                                <span class="px-4 py-2 bg-indigo-100 text-indigo-800 text-sm font-medium rounded-lg">
                                    <i class="fas fa-book mr-2"></i>{{ trim($subject) }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif

            <!-- Prospek Lulusan -->
            @if($jurusan->prospects)
                <div>
                    <label class="text-sm font-medium text-gray-500 mb-2 block">Prospek Lulusan</label>
                    <ul class="list-disc pl-6 space-y-1">
                        @foreach((array)$jurusan->prospects as $p)
                            <li class="text-gray-700">{{ $p }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mitra Jurusan -->
            @if($jurusan->partners)
                <div>
                    <label class="text-sm font-medium text-gray-500 mb-2 block">Mitra Jurusan</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach((array)$jurusan->partners as $mitra)
                            <div class="flex flex-col items-center">
                                @if(!empty($mitra['logo']))
                                    <img src="{{ asset($mitra['logo']) }}" alt="Logo {{ $mitra['name'] ?? '' }}" class="w-16 h-16 object-contain bg-gray-100 rounded mb-1">
                                @endif
                                <span class="text-gray-700 text-sm">{{ $mitra['name'] ?? '' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Biaya SPP -->
            @if($jurusan->spp_fee)
                <div>
                    <label class="text-sm font-medium text-gray-500 mb-2 block">Biaya SPP</label>
                    <div class="text-gray-700 font-semibold">Rp {{ number_format($jurusan->spp_fee,0,',','.') }}</div>
                </div>
            @endif

            <!-- Sertifikasi -->
            @if($jurusan->certifications)
                <div>
                    <label class="text-sm font-medium text-gray-500 mb-2 block">Sertifikasi yang Bisa Diperoleh</label>
                    <ul class="list-disc pl-6 space-y-1">
                        @foreach((array)$jurusan->certifications as $cert)
                            <li class="text-gray-700">{{ $cert }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Meta Info -->
            <div class="pt-6 border-t border-gray-100 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="text-gray-900 ml-2">{{ $jurusan->created_at->format('d M Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Terakhir diupdate:</span>
                    <span class="text-gray-900 ml-2">{{ $jurusan->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-gray-50 px-8 py-4 flex justify-between items-center border-t border-gray-100">
            <a href="{{ route('admin.jurusans.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <div class="flex space-x-3">
                <a href="{{ route('admin.jurusans.edit', $jurusan->id) }}" class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('admin.jurusans.destroy', $jurusan->id) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
