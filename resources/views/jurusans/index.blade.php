@extends('layouts.admin')

@section('title', 'Jurusan')
@section('page-title', 'Manajemen Jurusan')
@section('page-description', 'Kelola semua jurusan sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Jurusan</h3>
            <p class="text-gray-600 mt-1">Total: {{ $jurusans->count() }} jurusan</p>
        </div>
        <a href="{{ route('admin.jurusans.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
            <i class="fas fa-plus mr-2"></i>Tambah Jurusan
        </a>
    </div>

    <!-- Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($jurusans as $jurusan)
            <div class="card-hover bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="h-40 bg-gradient-to-br from-indigo-500 to-purple-600 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute transform rotate-45 bg-white w-32 h-32 -right-8 -top-8"></div>
                        <div class="absolute transform -rotate-45 bg-white w-32 h-32 -left-8 -bottom-8"></div>
                    </div>
                    @if($jurusan->photo_path)
                        <img src="{{ asset($jurusan->photo_path) }}" alt="{{ $jurusan->name }}" class="absolute inset-0 w-full h-full object-contain p-8">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-book-open text-white text-5xl opacity-50"></i>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <h4 class="font-bold text-gray-800 text-xl mb-2">{{ $jurusan->name }}</h4>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($jurusan->description), 120) }}</p>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-book mr-2"></i>{{ is_array($jurusan->subjects) ? count($jurusan->subjects) : 0 }} Mata Pelajaran
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.jurusans.show', $jurusan->id) }}" class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors text-sm font-medium">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.jurusans.edit', $jurusan->id) }}" class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors text-sm font-medium">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.jurusans.destroy', $jurusan->id) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <i class="fas fa-book-open text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada jurusan</h5>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan jurusan pertama.</p>
                <a href="{{ route('admin.jurusans.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Jurusan
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
