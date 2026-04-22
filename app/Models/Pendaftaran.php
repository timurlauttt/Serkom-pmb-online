<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pendaftaran extends Model
{
    protected $fillable = [
        'kode_pendaftaran',
        'email',
        'nama_lengkap',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp_siswa',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'no_hp_ortu',
        'alamat_ortu',
        'sekolah_asal',
        'alamat_sekolah_asal',
        'nisn',
        'tahun_lulus',
        'rata_rata_nilai',
        'jurusan_id',
        'ijazah_path',
        'akta_kelahiran_path',
        'kartu_keluarga_path',
        'pas_foto_path',
        'kip_path',
        'ktp_ortu_path',
        'prestasi_ekstrakurikuler',
        'alasan_memilih',
        'biaya_pendaftaran',
        'status_pembayaran',
        'bukti_pembayaran_path',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'paid_at',
        'status_pendaftaran',
        'catatan_admin'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_lulus' => 'integer',
        'rata_rata_nilai' => 'decimal:2',
        'biaya_pendaftaran' => 'integer',
        'paid_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate kode pendaftaran otomatis
        static::creating(function ($pendaftaran) {
            if (empty($pendaftaran->kode_pendaftaran)) {
                $pendaftaran->kode_pendaftaran = self::generateKodePendaftaran();
            }
        });
    }

    public static function generateKodePendaftaran()
    {
        do {
            $kode = 'REG' . date('Ymd') . strtoupper(Str::random(6));
        } while (self::where('kode_pendaftaran', $kode)->exists());

        return $kode;
    }

    // Relasi
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    // Helper methods
    public function isPaid()
    {
        return $this->status_pembayaran === 'paid';
    }

    public function isDiterima()
    {
        return $this->status_pendaftaran === 'diterima';
    }

    public function isDitolak()
    {
        return $this->status_pendaftaran === 'ditolak';
    }

    public function getStatusPembayaranBadgeAttribute()
    {
        return match($this->status_pembayaran) {
            'paid' => '<span class="badge bg-success">Lunas</span>',
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'failed' => '<span class="badge bg-danger">Gagal</span>',
            'expired' => '<span class="badge bg-secondary">Kadaluarsa</span>',
            default => '<span class="badge bg-secondary">-</span>',
        };
    }

    public function getStatusPendaftaranBadgeAttribute()
    {
        return match($this->status_pendaftaran) {
            'draft' => '<span class="badge bg-secondary">Draft</span>',
            'menunggu_pembayaran' => '<span class="badge bg-warning">Menunggu Pembayaran</span>',
            'verifikasi_dokumen' => '<span class="badge bg-info">Verifikasi Dokumen</span>',
            'diterima' => '<span class="badge bg-success">Diterima</span>',
            'ditolak' => '<span class="badge bg-danger">Ditolak</span>',
            default => '<span class="badge bg-secondary">-</span>',
        };
    }
}
