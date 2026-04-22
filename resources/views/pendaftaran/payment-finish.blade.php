@extends('utama.layouts.app')
@section('title', 'Status Pembayaran')

@push('styles')
<style>
    .finish-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 3rem 0;
        margin-top: 80px;
        text-align: center;
    }
    
    .finish-container {
        max-width: 600px;
        margin: 3rem auto;
        background: white;
        padding: 2.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .icon-success {
        width: 80px;
        height: 80px;
        background: #d1fae5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: #059669;
    }
    
    .icon-pending {
        width: 80px;
        height: 80px;
        background: #fef3c7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: #d97706;
    }
    
    .btn-primary {
        background: #3b82f6;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-top: 1rem;
    }
    
    .btn-primary:hover {
        background: #2563eb;
    }
    
    .info-box {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 8px;
        margin: 1.5rem 0;
        text-align: left;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    /* Responsive Mobile */
    @media (max-width: 768px) {
        .finish-header {
            padding: 2rem 1rem;
            margin-top: 60px;
        }
        
        .finish-header h1 {
            font-size: 1.5rem;
        }
        
        .finish-container {
            margin: 1.5rem 1rem;
            padding: 1.5rem;
        }
        
        .finish-container h2 {
            font-size: 1.25rem;
        }
        
        .finish-container p {
            font-size: 0.875rem;
        }
        
        .icon-success,
        .icon-pending {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
        
        .info-box {
            padding: 1rem;
        }
        
        .info-row {
            flex-direction: column;
            font-size: 0.875rem;
            padding: 0.5rem 0;
        }
        
        .btn-primary {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@section('content')
<div class="finish-header">
    <div class="container">
        <h1>Status Pembayaran</h1>
    </div>
</div>

<div class="container">
    <div class="finish-container">
        @if($pendaftaran->status_pembayaran === 'paid')
            <div class="icon-success">✓</div>
            <h2 style="color: #059669; margin-bottom: 1rem;">Pembayaran Berhasil!</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">
                Terima kasih telah menyelesaikan pembayaran. Pendaftaran Anda sedang dalam proses verifikasi.
            </p>
        @elseif($pendaftaran->bukti_pembayaran_path)
            <div class="icon-success">✓</div>
            <h2 style="color: #059669; margin-bottom: 1rem;">Bukti Pembayaran Terkirim!</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">
                Bukti pembayaran Anda telah kami terima dan sedang dalam proses verifikasi oleh admin. <br>
                Silakan cek status secara berkala.
            </p>
        @else
            <div class="icon-pending">⏱</div>
            <h2 style="color: #d97706; margin-bottom: 1rem;">Pembayaran Pending</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">
                Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran sesuai instruksi yang diberikan.
            </p>
        @endif

        <div class="info-box">
            <div class="info-row">
                <span style="color: #6b7280;">Kode Pendaftaran</span>
                <strong>{{ $pendaftaran->kode_pendaftaran }}</strong>
            </div>
            <div class="info-row">
                <span style="color: #6b7280;">NISN</span>
                <strong>{{ $pendaftaran->nisn }}</strong>
            </div>
            <div class="info-row">
                <span style="color: #6b7280;">Nama</span>
                <strong>{{ $pendaftaran->nama_lengkap }}</strong>
            </div>
            <div class="info-row">
                <span style="color: #6b7280;">Status Pembayaran</span>
                <strong style="color: {{ $pendaftaran->status_pembayaran === 'paid' ? '#059669' : '#d97706' }};">
                    {{ $pendaftaran->status_pembayaran === 'paid' ? 'Lunas' : 'Pending' }}
                </strong>
            </div>
        </div>

        <p style="color: #6b7280; margin: 1.5rem 0;">
            Simpan <strong>Kode Pendaftaran</strong> dan <strong>NISN</strong> Anda untuk cek status pendaftaran.
        </p>

        <div style="margin-top: 2rem;">
            <a href="{{ route('pendaftaran.check-status') }}" class="btn-primary">Cek Status Pendaftaran</a>
        </div>
    </div>
</div>
@endsection
