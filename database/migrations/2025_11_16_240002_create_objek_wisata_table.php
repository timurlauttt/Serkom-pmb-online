<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('objek_wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('alamat');
            $table->string('kota');
            $table->text('deskripsi')->nullable();
            $table->integer('harga_tiket')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('objek_wisata');
    }
};