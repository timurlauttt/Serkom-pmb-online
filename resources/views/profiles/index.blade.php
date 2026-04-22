@extends('layouts.admin')

@section('title', 'Profil Sekolah')
@section('page-title', 'Manajemen Profil Sekolah')
@section('page-description', 'Kelola informasi profil sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Profil Sekolah</h3>
            <p class="text-gray-600 mt-1">Informasi lengkap tentang sekolah</p>
        </div>
        @if($profiles->count() == 0)
            <a href="{{ route('admin.profiles.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                <i class="fas fa-plus mr-2"></i>Buat Profil
            </a>
        @endif
    </div>

    <!-- Content -->
    @forelse($profiles as $profile)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Profile Details -->
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Vision & Mission -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500"><strong>Visi</strong></label>
                            <p class="text-gray-700 mt-1">{{ $profile->vision ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Misi</label>
                            @if(is_array($profile->mission) && count($profile->mission) > 0)
                                <ul class="list-disc list-inside text-gray-700 mt-1 space-y-1">
                                    @foreach($profile->mission as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="text-gray-700 mt-1">{{ $profile->mission ?? 'Belum diisi' }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500"><strong>Akreditasi</strong></label>
                            <p class="text-lg font-semibold text-gray-800 mt-1">{{ $profile->accreditation ?? 'Belum diisi' }}</p>
                        </div>
                        @if(is_array($profile->facilities) && count($profile->facilities) > 0)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Fasilitas</label>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach($profile->facilities as $facility)
                                        @php
                                            // facility may be a string or an array/object with a name
                                            if (is_array($facility)) {
                                                $facilityName = $facility['name'] ?? '';
                                            } elseif (is_object($facility)) {
                                                $facilityName = $facility->name ?? '';
                                            } else {
                                                $facilityName = $facility;
                                            }
                                        @endphp
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">{{ $facilityName }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                @if($profile->history)
                    <div class="pt-6 border-t border-gray-100">
                        <label class="text-sm font-medium text-gray-500"><strong>Sejarah</strong></label>
                        <div class="text-gray-700 mt-2 prose max-w-none">
                            {!! nl2br(e($profile->history)) !!}
                        </div>
                    </div>
                @endif

                <!-- Struktur Organisasi -->
                @if($profile->org_chart_path)
                    <div class="pt-6">
                        <label class="text-sm font-medium text-gray-500"><strong>Struktur Organisasi</strong></label>
                        <div class="mt-3">
                            <img src="{{ asset($profile->org_chart_path) }}" alt="Struktur Organisasi" class="w-full max-w-4xl mx-auto rounded-lg shadow-md object-contain">
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex space-x-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.profiles.edit', $profile->id) }}" class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium">
                        <i class="fas fa-edit mr-2"></i>Edit Profil
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <i class="fas fa-school text-gray-400 text-2xl"></i>
            </div>
            <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada profil sekolah</h5>
            <p class="text-gray-500 mb-6">Buat profil sekolah untuk menampilkan informasi lengkap.</p>
            <a href="{{ route('admin.profiles.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all font-medium inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>Buat Profil
            </a>
        </div>
    @endforelse
</div>
@endsection
