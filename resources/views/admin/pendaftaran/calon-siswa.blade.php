@extends('layouts.admin')

@section('title', 'Data Pendaftaran Calon Siswa')
@section('page-title', 'Data Pendaftaran Calon Siswa')
@section('page-description', 'Kelola data pendaftaran calon siswa baru')
@section('content')

<div class="space-y-6">
	<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
		<form method="GET" action="{{ route('admin.pendaftaran.calon-siswa') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
			<div>
				<label class="block text-sm font-medium text-gray-700 mb-2">Cari Calon Siswa</label>
				<input
					type="text"
					name="search"
					value="{{ request('search') }}"
					placeholder="Nama, email, no HP..."
					class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
				>
			</div>

			<div>
				<label class="block text-sm font-medium text-gray-700 mb-2">Status Kelengkapan</label>
				<select name="kelengkapan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
					<option value="">Semua</option>
					<option value="lengkap" {{ request('kelengkapan') === 'lengkap' ? 'selected' : '' }}>Lengkap</option>
					<option value="belum_lengkap" {{ request('kelengkapan') === 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
				</select>
			</div>

			<div class="flex items-end gap-2">
				<button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
					<i class="fas fa-search mr-2"></i> Filter
				</button>
				<a href="{{ route('admin.pendaftaran.calon-siswa') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
					<i class="fas fa-redo"></i>
				</a>
			</div>
		</form>
	</div>

	<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
		@if($calonSiswas->count() > 0)
			<div class="overflow-x-auto">
				<table class="w-full">
					<thead class="bg-gray-50 border-b border-gray-200">
						<tr>
							<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
							<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kontak</th>
							<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Alamat Domisili</th>
							<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Data Dasar</th>
							<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status Profil</th>
							<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Terdaftar</th>
							<th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-200">
						@foreach($calonSiswas as $casis)
							@php
								$isLengkap =
									!empty($casis->jenis_kelamin) &&
									!empty($casis->status_menikah) &&
									!empty($casis->religion_id) &&
									!empty($casis->alamat_saat_ini) &&
									!empty($casis->kecamatan) &&
									!empty($casis->kabupaten_id) &&
									!empty($casis->provinsi_id) &&
									!empty($casis->tanggal_lahir) &&
									!empty($casis->tempat_lahir) &&
									!empty($casis->kewarganegaraan);
							@endphp
							<tr class="hover:bg-gray-50">
								<td class="px-6 py-4">
									<p class="text-sm font-semibold text-gray-900">{{ $casis->nama_lengkap }}</p>
								</td>
								<td class="px-6 py-4">
									<p class="text-sm text-gray-900">{{ $casis->email }}</p>
									<p class="text-xs text-gray-500">HP: {{ $casis->no_hp ?? '-' }}</p>
									<p class="text-xs text-gray-500">Telp: {{ $casis->nomor_telepon ?? '-' }}</p>
								</td>
								<td class="px-6 py-4 text-sm text-gray-700">
									<p>{{ $casis->alamat_saat_ini ?? '-' }}</p>
									<p class="text-xs text-gray-500 mt-1">
										{{ $casis->kecamatan ?? '-' }}, {{ optional($casis->kabupaten)->name ?? '-' }}, {{ optional($casis->provinsi)->name ?? '-' }}
									</p>
								</td>
								<td class="px-6 py-4 text-sm text-gray-700">
									<p>JK: {{ $casis->jenis_kelamin ?? '-' }}</p>
									<p>Status: {{ $casis->status_menikah ?? '-' }}</p>
									<p>Agama: {{ optional($casis->agama)->name ?? '-' }}</p>
									<p>Lahir: {{ $casis->tempat_lahir ?? '-' }}{{ $casis->tanggal_lahir ? ', ' . \Carbon\Carbon::parse($casis->tanggal_lahir)->format('d-m-Y') : '' }}</p>
								</td>
								<td class="px-6 py-4">
									@if($isLengkap)
										<span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lengkap</span>
									@else
										<span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum Lengkap</span>
									@endif
								</td>
								<td class="px-6 py-4 text-sm text-gray-500">
									{{ $casis->created_at?->format('d M Y H:i') }}
								</td>
								<td class="px-6 py-4 text-center">
									<a href="{{ route('admin.pendaftaran.calon-siswa.show', $casis->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 text-xs font-semibold hover:bg-blue-200">
										<i class="fas fa-eye mr-1.5"></i> Detail
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="px-6 py-4 border-t border-gray-200">
				{{ $calonSiswas->links() }}
			</div>
		@else
			<div class="text-center py-12">
				<i class="fas fa-user-slash text-gray-300 text-5xl mb-4"></i>
				<p class="text-gray-500">Belum ada data calon siswa yang registrasi</p>
			</div>
		@endif
	</div>
</div>

@endsection