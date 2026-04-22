<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jurusans', function (Blueprint $table) {
            // 3 foto representatif
            $table->string('photo_path_2')->nullable()->after('photo_path');
            $table->string('photo_path_3')->nullable()->after('photo_path_2');
            // mata pelajaran unggulan (array) - already exists as 'subjects'
            // prospek lulusan (array) - migrate from text to json
            $table->json('prospects')->nullable()->change();
            // mitra jurusan (array: name + logo)
            $table->json('partners')->nullable()->after('prospects');
            // biaya SPP
            $table->decimal('spp_fee', 12, 2)->nullable()->after('partners');
            // sertifikasi yang bisa diperoleh (array)
            $table->json('certifications')->nullable()->after('spp_fee');
        });
    }

    public function down()
    {
        Schema::table('jurusans', function (Blueprint $table) {
            $table->dropColumn(['photo_path_2', 'photo_path_3', 'partners', 'spp_fee', 'certifications']);
            // revert prospects to text
            $table->text('prospects')->nullable()->change();
        });
    }
};
