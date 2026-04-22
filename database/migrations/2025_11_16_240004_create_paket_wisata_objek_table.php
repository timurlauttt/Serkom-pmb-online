<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('paket_wisata_objek', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paket');
            $table->unsignedBigInteger('id_objek_wisata');
            $table->timestamps();
            $table->foreign('id_paket')->references('id')->on('paket_wisata')->onDelete('cascade');
            $table->foreign('id_objek_wisata')->references('id')->on('objek_wisata')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('paket_wisata_objek');
    }
};