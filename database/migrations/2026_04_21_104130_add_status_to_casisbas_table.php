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
            $table->enum('status_penerimaan', ['menunggu', 'diterima', 'ditolak'])->default('menunggu')->after('religion_id');
            $table->text('catatan_penerimaan')->nullable()->after('status_penerimaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('casisbas', function (Blueprint $table) {
            $table->dropColumn(['status_penerimaan', 'catatan_penerimaan']);
        });
    }
};
