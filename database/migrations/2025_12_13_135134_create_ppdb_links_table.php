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
        Schema::create('ppdb_links', function (Blueprint $table) {
            $table->id();
            $table->string('nama_link');
            $table->string('url');
            $table->enum('jenis', ['pendaftaran', 'info', 'hasil', 'lainnya'])->default('info');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_links');
    }
};
