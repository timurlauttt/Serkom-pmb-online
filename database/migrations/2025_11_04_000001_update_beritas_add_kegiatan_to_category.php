<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Add 'Kegiatan' to the ENUM list so inserts using that value won't be truncated
        DB::statement("ALTER TABLE `beritas` MODIFY `category` ENUM('Event','Kegiatan','Kesiswaan','Kurikulum','Prestasi','Humas','Iptek') NOT NULL DEFAULT 'Humas'");
    }

    public function down()
    {
        // Revert to previous enum list (removes 'Kegiatan')
        DB::statement("ALTER TABLE `beritas` MODIFY `category` ENUM('Event','Kesiswaan','Kurikulum','Prestasi','Humas','Iptek') NOT NULL DEFAULT 'Humas'");
    }
};
