@extends('utama.layouts.app')
@section('title', 'Cek Status Pendaftaran')

@push('styles')
<style>
    .check-status-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 3rem 0;
        margin-top: 80px;
        text-align: center;
    }
    
    .check-form-container {
        max-width: 1200px;
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
        .check-status-header {
            padding: 2rem 1rem;
            margin-top: 80px;
        }
        
        .check-status-header h1 {
            font-size: 1.5rem;
        }
        
        .check-status-header p {
            font-size: 0.875rem;
        }
        
        .check-form-container {
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
<div class="check-status-header">
    <div class="container">
        <h1 class="mobile:text-lg" >Cek Status Pendaftaran</h1>
        <p class="mobile:text-sm" >Masukkan NISN untuk melihat status pendaftaran Anda</p>
    </div>
</div>

<div class="container">
    <div class="check-form-container">
        @if($errors->any())
        <div class="alert-danger">
            {{ $errors->first('nisn') }}
        </div>
        @endif

        <div class="info-box">
            <strong>Informasi:</strong> Masukkan NISN yang Anda gunakan saat mendaftar untuk melihat status pendaftaran Anda.
        </div>

        <form action="{{ route('pendaftaran.get-status') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" class="form-control" placeholder="Contoh: 0012345678" value="{{ old('nisn') }}" required>
            </div>
            
            <button type="submit" class="btn-primary">Cek Status</button>
        </form>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; text-align: center;">
            <p class="mobile:text-sm" style="color: #6b7280; margin-bottom: 0.5rem;">Belum mendaftar?</p>
            <a class="mobile:text-base" href="{{ route('pendaftaran.create') }}" style="color: #3b82f6; font-weight: 600;">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
