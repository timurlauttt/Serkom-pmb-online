<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->enum('album', [
                'Kegiatan Sekolah',
                'Ekstrakurikuler',
                'Fasilitas',
                'Prestasi',
                'Guru & Staff',
                'Kelas',
                'Kegiatan Akademik',
                'Event Besar',
                'Alumni',
            ])->default('Kegiatan Sekolah')->after('title');
            $table->unsignedBigInteger('jurusan_id')->nullable()->after('album');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->dropForeign(['jurusan_id']);
            $table->dropColumn(['album', 'jurusan_id']);
        });
    }
};
