<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('history')->nullable();
            $table->text('vision_mission')->nullable();
            $table->string('org_chart_path')->nullable();
            $table->json('facilities')->nullable(); // [{"name":"Lab","image":"/images/profile/lab.jpg"}, ...]
            $table->string('accreditation')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
