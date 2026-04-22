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
        Schema::create('casisbas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->string('password');
            $table->string('alamat_ktp')->nullable();
            $table->string('alamat_saat_ini')->nullable();
            $table->string('kecamatan')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('kewarganegaraan')->nullable(); // WNI/WNA
            $table->string('negara_wna')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tempat_lahir_negara')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->enum('status_menikah', ['Belum menikah', 'Menikah', 'Lain-lain'])->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
                        // Foreign key constraints
                        $table->foreign('provinsi_id')->references('id')->on('provinces')->onDelete('set null');
                        $table->foreign('kabupaten_id')->references('id')->on('regencies')->onDelete('set null');
                        $table->foreign('religion_id')->references('id')->on('religions')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casisbas');
    }
};
