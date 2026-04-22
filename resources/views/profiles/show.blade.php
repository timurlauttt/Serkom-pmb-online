@extends('layouts.admin')

@section('title', 'Detail Profile Sekolah')
@section('page-title', 'Detail Profile Sekolah')
@section('page-description', 'Informasi lengkap profile sekolah')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 space-y-8">
            <!-- Vision -->
            <div class="pb-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-eye text-purple-500 mr-3"></i>
                    Visi Sekolah
                </h2>
                <p class="text-gray-700 leading-relaxed bg-purple-50 p-4 rounded-lg">
                    {{ $profile->vision }}
                </p>
            </div>

            <!-- Mission -->
            <div class="pb-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-bullseye text-pink-500 mr-3"></i>
                    Misi Sekolah
                </h2>
                @if(is_array($profile->mission) && count($profile->mission) > 0)
                    <ol class="space-y-2">
                        @foreach($profile->mission as $item)
                            <li class="flex items-start bg-pink-50 p-3 rounded-lg">
                                <span class="flex-shrink-0 w-6 h-6 bg-pink-500 text-white rounded-full flex items-center justify-center text-xs font-semibold mr-3 mt-0.5">
                                    {{ $loop->iteration }}
                                </span>
                                <span class="text-gray-700 flex-1">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="text-gray-700 leading-relaxed bg-pink-50 p-4 rounded-lg">
                        {{ $profile->mission }}
                    </p>
                @endif
            </div>

            <!-- History -->
            <div class="pb-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-history text-blue-500 mr-3"></i>
                    Sejarah Sekolah
                </h2>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line bg-blue-50 p-4 rounded-lg">
                    {{ $profile->history }}
                </p>
            </div>

            <!-- Facilities -->
            <div class="pb-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-building text-green-500 mr-3"></i>
                    Fasilitas Sekolah
                </h2>
                @if(is_array($profile->facilities) && count($profile->facilities) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($profile->facilities as $facility)
                            @php
                                if (is_array($facility)) {
                                    $facilityName = $facility['name'] ?? '';
                                } elseif (is_object($facility)) {
                                    $facilityName = $facility->name ?? '';
                                } else {
                                    $facilityName = $facility;
                                }
                            @endphp
                            <div class="flex items-center bg-green-50 p-3 rounded-lg">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-700">{{ $facilityName }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-700 leading-relaxed bg-green-50 p-4 rounded-lg">
                        {{ $profile->facilities }}
                    </p>
                @endif
            </div>

            <!-- Accreditation -->
            <div class="pb-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-certificate text-yellow-500 mr-3"></i>
                    Akreditasi
                </h2>
                <div class="inline-flex items-center bg-yellow-100 text-yellow-800 px-6 py-3 rounded-lg font-bold text-2xl">
                    {{ $profile->accreditation }}
                    @if($profile->accreditation == 'A')
                        <span class="ml-2 text-base font-normal">(Unggul)</span>
                    @elseif($profile->accreditation == 'B')
                        <span class="ml-2 text-base font-normal">(Baik)</span>
                    @elseif($profile->accreditation == 'C')
                        <span class="ml-2 text-base font-normal">(Cukup)</span>
                    @endif
                </div>
            </div>

            <!-- Organization Chart -->
            @if($profile->org_chart_path)
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-sitemap text-indigo-500 mr-3"></i>
                        Struktur Organisasi
                    </h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <img src="{{ asset('storage/' . $profile->org_chart_path) }}" alt="Organization Chart" class="w-full rounded-lg shadow-md">
                    </div>
                </div>
            @endif

            <!-- Meta Info -->
            <div class="pt-6 border-t border-gray-100 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="text-gray-900 ml-2">{{ $profile->created_at->format('d M Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Terakhir diupdate:</span>
                    <span class="text-gray-900 ml-2">{{ $profile->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-gray-50 px-8 py-4 flex justify-between items-center border-t border-gray-100">
            <a href="{{ route('admin.profiles.index') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <div class="flex space-x-3">
                <a href="{{ route('admin.profiles.edit', $profile->id) }}" class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors font-medium">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
