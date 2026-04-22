@extends('utama.layouts.app')
@section('title', 'Bayar Nanti')

@push('styles')
<style>
    .pay-later-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 3rem 0;
        margin-top: 80px;
        text-align: center;
    }
    
    .pay-later-container {
        max-width: 500px;
        margin: 3rem auto;
        background: white;
        padding: 2.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #374151;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        font-size: 1rem;
    }
    
    .btn-primary {
        background: #3b82f6;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
    }
    
    .btn-primary:hover {
        background: #2563eb;
    }
    
    .alert-danger {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }
    
    .info-box {
        background: #f0f9ff;
        border: 1px solid #bfdbfe;
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }
    
    /* Responsive Mobile */
    @media (max-width: 768px) {
        .pay-later-header {
            padding: 2rem 1rem;
            margin-top: 60px;
        }
        
        .pay-later-header h1 {
            font-size: 1.5rem;
        }
        
        .pay-later-header p {
            font-size: 0.875rem;
        }
        
        .pay-later-container {
            margin: 1.5rem 1rem;
            padding: 1.5rem;
        }
        
        .form-control {
            font-size: 0.875rem;
        }
        
        .btn-primary {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@section('content')
<div class="pay-later-header">
    <div class="container">
        <h1>Bayar Nanti</h1>
        <p>Lanjutkan pembayaran pendaftaran yang telah Anda buat sebelumnya</p>
    </div>
</div>

<div class="container">
    <div class="pay-later-container">
        @if($errors->any())
        <div class="alert-danger">
            {{ $errors->first('error') ?? 'Data yang Anda masukkan tidak valid. Periksa kembali NISN dan Kode Pendaftaran Anda.' }}
        </div>
        @endif

        <div class="info-box">
            <strong>Informasi:</strong> Masukkan NISN dan Kode Pendaftaran yang Anda terima saat mendaftar untuk melanjutkan pembayaran.
        </div>

        <form action="{{ route('pendaftaran.process-pay-later') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control" placeholder="Contoh: 0012345678" value="{{ old('nisn') }}" required>
            </div>

            <div class="form-group">
                <label>Kode Pendaftaran</label>
                <input type="text" name="kode_pendaftaran" class="form-control" placeholder="Contoh: REG20250101ABC123" value="{{ old('kode_pendaftaran') }}" required>
            </div>
            
            <button type="submit" class="btn-primary">Lanjutkan Pembayaran</button>
        </form>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; text-align: center;">
            <p style="color: #6b7280; margin-bottom: 0.5rem;">Ingin mengecek status pendaftaran?</p>
            <a href="{{ route('pendaftaran.check-status') }}" style="color: #3b82f6; font-weight: 600;">Cek Status Pendaftaran</a>
        </div>
    </div>
</div>
@endsection
