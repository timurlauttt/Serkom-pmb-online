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
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // siswa, guru, rombel, jurusan
            $table->string('label'); // Siswa, Guru dan Tata Usaha, dll
            $table->integer('value'); // angka statistik
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // fa-user, fa-chalkboard-teacher, dll
            $table->string('color')->default('primary'); // primary, success, info, warning
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};
