@extends('layouts.admin')

@section('title', 'Pendaftaran')
@section('page-title', 'Manajemen Pendaftaran')
@section('page-description', 'Kelola semua pendaftaran siswa baru')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Daftar Pendaftaran</h3>
            <p class="text-gray-600 mt-1">Total: {{ $pendaftarans->count() ?? 0 }} pendaftar</p>
        </div>
        <div class="flex space-x-3">
            <button class="px-4 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors font-medium">
                <i class="fas fa-file-excel mr-2"></i>Export Excel
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-sm font-medium text-gray-700 mb-2 block">Status</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Semua Status</option>
                    <option>Pending</option>
                    <option>Disetujui</option>
                    <option>Ditolak</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700 mb-2 block">Jurusan</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Semua Jurusan</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700 mb-2 block">Tanggal</label>
                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-end">
                <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if(isset($pendaftarans) && $pendaftarans->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email/Telepon</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pendaftarans as $index => $pendaftaran)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $pendaftaran->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $pendaftaran->nisn ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $pendaftaran->email }}</div>
                                <div class="text-sm text-gray-500">{{ $pendaftaran->telepon }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ $pendaftaran->jurusan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pendaftaran->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                    $status = $pendaftaran->status ?? 'pending';
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="viewDetail({{ $pendaftaran->id }})" class="text-blue-600 hover:text-blue-900 transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editStatus({{ $pendaftaran->id }}, '{{ $pendaftaran->status ?? 'pending' }}')" class="text-yellow-600 hover:text-yellow-900 transition-colors" title="Edit Status">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deletePendaftaran({{ $pendaftaran->id }})" class="text-red-600 hover:text-red-900 transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <i class="fas fa-user-plus text-gray-400 text-2xl"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-900 mb-2">Belum ada pendaftaran</h5>
                <p class="text-gray-500">Pendaftaran siswa baru akan muncul di sini.</p>
            </div>
        @endif
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Detail Pendaftaran</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <div id="detailContent" class="p-6">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Edit Status Modal -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full">
        <div class="p-6 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Edit Status Pendaftaran</h3>
                <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <form id="statusForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending">Pending</option>
                        <option value="approved">Disetujui</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
                
                <div>
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan
                    </label>
                    <textarea name="catatan" id="catatan" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Tambahkan catatan (opsional)"></textarea>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-100">
                <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all font-medium">
                    <i class="fas fa-save mr-2"></i>Update Status
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function viewDetail(id) {
        document.getElementById('detailModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Fetch detail data (you need to create this endpoint)
        fetch(`/admin/pendaftaran/${id}`)
            .then(response => response.json())
            .then(data => {
                const content = `
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                                <p class="text-gray-900 mt-1">${data.nama}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">NISN</label>
                                <p class="text-gray-900 mt-1">${data.nisn || '-'}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Email</label>
                                <p class="text-gray-900 mt-1">${data.email}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Telepon</label>
                                <p class="text-gray-900 mt-1">${data.telepon}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Jurusan</label>
                                <p class="text-gray-900 mt-1">${data.jurusan}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Status</label>
                                <span class="inline-block px-3 py-1 mt-1 text-xs font-semibold rounded-full ${
                                    data.status === 'approved' ? 'bg-green-100 text-green-800' :
                                    data.status === 'rejected' ? 'bg-red-100 text-red-800' :
                                    'bg-yellow-100 text-yellow-800'
                                }">${data.status === 'approved' ? 'Disetujui' : data.status === 'rejected' ? 'Ditolak' : 'Pending'}</span>
                            </div>
                        </div>
                        ${data.alamat ? `
                            <div>
                                <label class="text-sm font-medium text-gray-500">Alamat</label>
                                <p class="text-gray-900 mt-1">${data.alamat}</p>
                            </div>
                        ` : ''}
                        <div class="pt-4 border-t border-gray-100">
                            <label class="text-sm font-medium text-gray-500">Tanggal Pendaftaran</label>
                            <p class="text-gray-900 mt-1">${new Date(data.created_at).toLocaleDateString('id-ID', { 
                                year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' 
                            })}</p>
                        </div>
                    </div>
                `;
                document.getElementById('detailContent').innerHTML = content;
            })
            .catch(error => {
                document.getElementById('detailContent').innerHTML = '<p class="text-red-500">Error loading data</p>';
            });
    }
    
    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function editStatus(id, currentStatus) {
        document.getElementById('statusModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('status').value = currentStatus;
        document.getElementById('statusForm').action = `/admin/pendaftaran/${id}`;
    }
    
    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function deletePendaftaran(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/pendaftaran/${id}`;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush
@endsection
