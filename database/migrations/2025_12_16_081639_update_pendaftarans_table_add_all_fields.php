<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Hapus kolom lama yang tidak dipakai
            $table->dropColumn(['paket', 'harga']);
            
            // Data Pribadi Siswa
            $table->string('kode_pendaftaran')->unique()->after('id');
            $table->string('email');
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('no_hp_siswa');
            
            // Data Orang Tua
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('nama_wali')->nullable();
            $table->string('no_hp_ortu');
            $table->text('alamat_ortu');
            
            // Data Sekolah Asal
            $table->string('sekolah_asal');
            $table->text('alamat_sekolah_asal');
            $table->string('nisn')->unique();
            $table->year('tahun_lulus');
            $table->decimal('rata_rata_nilai', 5, 2); // 0.00 - 100.00
            
            // Jurusan yang diminati
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            
            // Upload Dokumen (path file)
            $table->string('ijazah_path');
            $table->string('akta_kelahiran_path');
            $table->string('kartu_keluarga_path');
            $table->string('pas_foto_path');
            $table->string('kip_path')->nullable();
            $table->string('ktp_ortu_path');
            
            // Data Tambahan
            $table->text('prestasi_ekstrakurikuler')->nullable();
            $table->text('alasan_memilih');
            
            // Pembayaran & Status
            $table->integer('biaya_pendaftaran')->default(50000);
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed', 'expired'])->default('pending');
            $table->string('midtrans_order_id')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            
            // Status Pendaftaran
            $table->enum('status_pendaftaran', [
                'draft',
                'menunggu_pembayaran',
                'verifikasi_dokumen',
                'diterima',
                'ditolak'
            ])->default('draft');
            $table->text('catatan_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Kembalikan kolom lama
            $table->string('paket');
            $table->integer('harga');
            
            // Hapus kolom baru
            $table->dropColumn([
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
                'midtrans_order_id',
                'midtrans_transaction_id',
                'paid_at',
                'status_pendaftaran',
                'catatan_admin'
            ]);
            
            $table->dropForeign(['jurusan_id']);
            $table->dropColumn('jurusan_id');
        });
    }
};
