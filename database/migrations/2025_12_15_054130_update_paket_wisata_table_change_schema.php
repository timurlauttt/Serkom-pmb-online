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
        // Drop kolom id_hotel jika ada (tanpa foreign key dulu karena sudah dihapus sebelumnya)
        if (Schema::hasColumn('paket_wisata', 'id_hotel')) {
            Schema::table('paket_wisata', function (Blueprint $table) {
                // Try to drop foreign key/index first (if present) to avoid MySQL error.
                try {
                    $table->dropForeign(['id_hotel']);
                } catch (\Throwable $e) {
                    // ignore if foreign key does not exist
                }

                $table->dropColumn('id_hotel');
            });
        }
        
        // Tambah kolom baru
        Schema::table('paket_wisata', function (Blueprint $table) {
            if (!Schema::hasColumn('paket_wisata', 'kategori')) {
                $table->string('kategori')->nullable()->after('nama_paket');
            }
            if (!Schema::hasColumn('paket_wisata', 'akomodasi')) {
                $table->json('akomodasi')->nullable()->after('harga');
            }
            if (!Schema::hasColumn('paket_wisata', 'objek_wisata')) {
                $table->json('objek_wisata')->nullable()->after('akomodasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_wisata', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'akomodasi', 'objek_wisata']);
            $table->unsignedBigInteger('id_hotel')->nullable();
        });
    }
};
