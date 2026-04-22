@extends('utama.layouts.app')
@section('title', 'Pembayaran Pendaftaran')

@push('styles')
<style>
    .payment-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 3rem 0;
        margin-top: 80px;
        text-align: center;
    }
    
    .payment-container {
        max-width: 600px;
        margin: 3rem auto;
        background: white;
        padding: 2.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .payment-info {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }
    
    .payment-info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .payment-info-row:last-child {
        border-bottom: none;
        font-weight: 600;
        font-size: 1.25rem;
        color: #1e3a8a;
    }
    
    .bank-info {
        background: #ecfdf5;
        border: 1px solid #6ee7b7;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: center;
    }

    .bank-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: #059669;
        margin: 0.5rem 0;
        font-family: monospace;
    }

    .btn-pay {
        background: #10b981;
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 4px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        transition: background 0.3s;
    }
    
    .btn-pay:hover {
        background: #059669;
    }

    /* Responsive Mobile */
    @media (max-width: 768px) {
        .payment-header {
            padding: 2rem 1rem;
            margin-top: 60px;
        }
        
        .payment-header h1 {
            font-size: 1.5rem;
        }
        
        .payment-container {
            margin: 1rem;
            padding: 1rem;
            border-radius: 12px;
        }
        
        .payment-info {
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="payment-header">
    <div class="container">
        <h1>Pembayaran Pendaftaran</h1>
        <p>Selesaikan pembayaran untuk melanjutkan proses pendaftaran</p>
    </div>
</div>

<div class="container">
    <div class="payment-container">
        @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ session('error') }}
        </div>
        @endif

        <div class="payment-info">
            <h3 style="margin-bottom: 1rem; color: #1e3a8a;">Detail Pembayaran</h3>
            <div class="payment-info-row">
                <span>Kode Pendaftaran</span>
                <strong>{{ $pendaftaran->kode_pendaftaran }}</strong>
            </div>
            <div class="payment-info-row">
                <span>Nama</span>
                <strong>{{ $pendaftaran->nama_lengkap }}</strong>
            </div>
            <div class="payment-info-row">
                <span>Jurusan</span>
                <strong>{{ $pendaftaran->jurusan->name ?? '-' }}</strong>
            </div>
            <div class="payment-info-row">
                <span>Biaya Pendaftaran</span>
                <strong style="color: #059669;">Rp {{ number_format($pendaftaran->biaya_pendaftaran, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="bank-info">
            <p class="text-gray-600 mb-2">Silakan transfer ke rekening berikut:</p>
            <div class="text-xl font-bold text-gray-800">BNI</div>
            <div class="bank-number">0153364349</div>
            <div class="text-gray-700 font-medium">SMK TAMAN SISWA PURWOKERTO</div>
        </div>

        <form action="{{ route('pendaftaran.payment.upload', $pendaftaran->kode_pendaftaran) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="bukti_pembayaran" class="block mb-2 text-sm font-medium text-gray-900">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2">
                <p class="mt-1 text-sm text-gray-500">Format: JPG, JPEG, PNG.</p>
            </div>

            <button type="submit" class="btn-pay">Kirim Bukti Pembayaran</button>
        </form>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; text-align: center;">
            <p style="color: #6b7280;">Atau bayar nanti?</p>
            <p style="margin-top: 0.5rem;">Simpan <strong>Kode Pendaftaran: {{ $pendaftaran->kode_pendaftaran }}</strong> dan <strong>NISN: {{ $pendaftaran->nisn }}</strong> Anda</p>
            <a href="{{ route('pendaftaran.pay-later') }}" style="color: #3b82f6; font-weight: 600;">Bayar Nanti</a>
        </div>
    </div>
</div>
@endsection
