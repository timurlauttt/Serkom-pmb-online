<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('transportasi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('nama_provider');
            $table->integer('harga');
            $table->string('kontak')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('transportasi');
    }
};