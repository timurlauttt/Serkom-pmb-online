@extends('utama.layouts.app')
@section('title', 'Status Pendaftaran')

@push('styles')
<style>
    .status-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 3rem 0;
        margin-top: 80px;
        text-align: center;
    }
    
    .status-container {
        max-width: 800px;
        margin: 3rem auto;
        background: white;
        padding: 2.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .status-card {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .status-card h3 {
        margin-bottom: 1rem;
        color: #1e3a8a;
    }
    
    .info-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        width: 200px;
        font-weight: 600;
        color: #6b7280;
    }
    
    .info-value {
        flex: 1;
        color: #111827;
    }
    
    .badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 4px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }
    
    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }
    
    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }
    
    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .badge-secondary {
        background: #f3f4f6;
        color: #4b5563;
    }
    
    .btn-pay {
        background: #10b981;
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-top: 1rem;
    }
    
    .btn-pay:hover {
        background: #059669;
    }
    
    .alert-info {
        background: #f0f9ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }
    
    .timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -1.5rem;
        top: 0.5rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #d1d5db;
    }
    
    .timeline-item.active::before {
        background: #3b82f6;
    }
    
    .timeline-item.completed::before {
        background: #10b981;
    }
    
    /* Responsive Mobile */
    @media (max-width: 768px) {
        .status-header {
            padding: 2rem 1rem;
            margin-top: 60px;
        }
        
        .status-header h1 {
            font-size: 1.5rem;
        }
        
        .status-header p {
            font-size: 0.875rem;
        }
        
        .status-container {
            margin: 1.5rem 1rem;
            padding: 1.5rem;
        }
        
        .status-card {
            padding: 1rem;
        }
        
        .info-row {
            flex-direction: column;
            padding: 0.5rem 0;
        }
        
        .info-label {
            width: 100%;
            margin-bottom: 0.25rem;
            font-size: 0.875rem;
        }
        
        .info-value {
            font-size: 0.875rem;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .btn-pay {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
        
        .timeline {
            padding-left: 1rem;
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@section('content')
<div class="status-header">
    <div class="container">
        <h1>Status Pendaftaran</h1>
        <p>{{ $pendaftaran->nama_lengkap }}</p>
    </div>
</div>

<div class="container">
    <div class="status-container">
        <!-- Info Pendaftaran -->
        <div class="status-card">
            <h3>Informasi Pendaftaran</h3>
            <div class="info-row">
                <div class="info-label">Kode Pendaftaran</div>
                <div class="info-value"><strong>{{ $pendaftaran->kode_pendaftaran }}</strong></div>
            </div>
            <div class="info-row">
                <div class="info-label">NISN</div>
                <div class="info-value">{{ $pendaftaran->nisn }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ $pendaftaran->nama_lengkap }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $pendaftaran->email }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jurusan</div>
                <div class="info-value">{{ $pendaftaran->jurusan->name ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Daftar</div>
                <div class="info-value">{{ $pendaftaran->created_at->format('d F Y H:i') }}</div>
            </div>
        </div>

        <!-- Status Pembayaran -->
        <div class="status-card">
            <h3>Status Pembayaran</h3>
            <div class="info-row">
                <div class="info-label">Status</div>
                <div class="info-value">
                    @if($pendaftaran->status_pembayaran === 'paid')
                        <span class="badge badge-success">✓ Lunas</span>
                    @elseif($pendaftaran->status_pembayaran === 'pending')
                        <span class="badge badge-warning">Menunggu Pembayaran</span>
                    @elseif($pendaftaran->status_pembayaran === 'failed')
                        <span class="badge badge-danger">Gagal</span>
                    @else
                        <span class="badge badge-secondary">{{ ucfirst($pendaftaran->status_pembayaran) }}</span>
                    @endif
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Biaya</div>
                <div class="info-value">Rp {{ number_format($pendaftaran->biaya_pendaftaran, 0, ',', '.') }}</div>
            </div>
            @if($pendaftaran->paid_at)
            <div class="info-row">
                <div class="info-label">Dibayar Pada</div>
                <div class="info-value">{{ $pendaftaran->paid_at->format('d F Y H:i') }}</div>
            </div>
            @endif

            @if(!$pendaftaran->isPaid())
            <div style="margin-top: 1rem;">
                <a href="{{ route('pendaftaran.payment', $pendaftaran->kode_pendaftaran) }}" class="btn-pay">
                    {{ $pendaftaran->bukti_pembayaran_path ? 'Upload Ulang Bukti' : 'Upload Bukti Bayar' }}
                </a>
                @if($pendaftaran->bukti_pembayaran_path)
                    <p class="text-sm text-green-600 mt-2">✓ Bukti pembayaran sudah diupload, menunggu verifikasi.</p>
                @endif
            </div>
            @endif
        </div>

        <!-- Status Pendaftaran -->
        <div class="status-card">
            <h3>Status Pendaftaran</h3>
            <div class="info-row">
                <div class="info-label">Status</div>
                <div class="info-value">
                    @if($pendaftaran->status_pendaftaran === 'diterima')
                        <span class="badge badge-success">✓ Diterima</span>
                    @elseif($pendaftaran->status_pendaftaran === 'ditolak')
                        <span class="badge badge-danger">✗ Ditolak</span>
                    @elseif($pendaftaran->status_pendaftaran === 'verifikasi_dokumen')
                        <span class="badge badge-info">Verifikasi Dokumen</span>
                    @elseif($pendaftaran->status_pendaftaran === 'menunggu_pembayaran')
                        <span class="badge badge-warning">Menunggu Pembayaran</span>
                    @else
                        <span class="badge badge-secondary">{{ ucfirst($pendaftaran->status_pendaftaran) }}</span>
                    @endif
                </div>
            </div>

            @if($pendaftaran->catatan_admin)
            <div class="info-row">
                <div class="info-label">Catatan</div>
                <div class="info-value">{{ $pendaftaran->catatan_admin }}</div>
            </div>
            @endif

            <div style="margin-top: 1.5rem;">
                <strong>Timeline Proses:</strong>
                <div class="timeline" style="margin-top: 1rem;">
                    <div class="timeline-item completed">
                        <strong>Pendaftaran Dibuat</strong><br>
                        <small>{{ $pendaftaran->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <div class="timeline-item {{ $pendaftaran->isPaid() ? 'completed' : ($pendaftaran->status_pembayaran === 'pending' ? 'active' : '') }}">
                        <strong>Pembayaran</strong><br>
                        <small>{{ $pendaftaran->paid_at ? $pendaftaran->paid_at->format('d M Y H:i') : '-' }}</small>
                    </div>
                    <div class="timeline-item {{ $pendaftaran->status_pendaftaran === 'verifikasi_dokumen' ? 'active' : ($pendaftaran->status_pendaftaran === 'diterima' || $pendaftaran->status_pendaftaran === 'ditolak' ? 'completed' : '') }}">
                        <strong>Verifikasi Dokumen</strong>
                    </div>
                    <div class="timeline-item {{ $pendaftaran->status_pendaftaran === 'diterima' || $pendaftaran->status_pendaftaran === 'ditolak' ? 'completed' : '' }}">
                        <strong>Keputusan Akhir</strong>
                    </div>
                </div>
            </div>
        </div>

        @if($pendaftaran->isDiterima())
        <div class="alert-info">
            <strong>Selamat!</strong> Pendaftaran Anda telah diterima. Silakan tunggu informasi lebih lanjut melalui email atau kontak yang terdaftar.
        </div>
        @endif
    </div>
</div>
@endsection
