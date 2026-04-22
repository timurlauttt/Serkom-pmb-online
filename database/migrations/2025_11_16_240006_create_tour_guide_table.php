<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('tour_guide', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('bahasa');
            $table->integer('harga_per_hari');
            $table->text('pengalaman')->nullable();
            $table->string('kontak')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('tour_guide');
    }
};