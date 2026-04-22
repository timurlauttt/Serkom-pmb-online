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
        Schema::table('casisbas', function (Blueprint $table) {
            $table->unsignedBigInteger('tempat_lahir_provinsi_id')->nullable()->after('tempat_lahir');
            $table->foreign('tempat_lahir_provinsi_id')->references('id')->on('provinces')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('casisbas', function (Blueprint $table) {
            $table->dropForeign(['tempat_lahir_provinsi_id']);
            $table->dropColumn('tempat_lahir_provinsi_id');
        });
    }
};
