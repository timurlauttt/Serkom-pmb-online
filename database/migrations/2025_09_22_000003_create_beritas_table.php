<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('image_path')->nullable();
            $table->string('author')->nullable();
            $table->enum('category', ['Event','Kesiswaan','Kurikulum','Prestasi','Humas','Iptek'])->default('Humas');
            $table->timestamp('posted_at')->nullable();
            $table->string('hashtags')->nullable(); // comma separated
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beritas');
    }
};
