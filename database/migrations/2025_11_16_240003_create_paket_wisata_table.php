<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('paket_wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('slug')->unique();
            $table->integer('durasi_hari');
            $table->integer('harga');
            $table->unsignedBigInteger('id_hotel')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->foreign('id_hotel')->references('id')->on('hotels')->onDelete('set null');
        });
    }
    public function down() {
        Schema::dropIfExists('paket_wisata');
    }
};