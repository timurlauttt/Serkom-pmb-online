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
        // If the table doesn't exist yet (migrations order changed or create migration removed),
        // create the table with the target schema so migrate:fresh won't fail.
        if (!Schema::hasTable('ekstrakurikulers')) {
            Schema::create('ekstrakurikulers', function (Blueprint $table) {
                $table->id();
                // prefer the final column names (use 'nama' instead of 'nama_eskul')
                $table->string('nama');
                $table->string('slug')->unique()->nullable();
                $table->string('icon')->default('fas fa-star');
                $table->string('thumbnail')->nullable();
                $table->string('pembina')->nullable();
                $table->string('jadwal')->nullable();
                $table->json('tags')->nullable();
                $table->boolean('is_active')->default(true);
                $table->text('deskripsi')->nullable(false);
                $table->json('fotos')->nullable();
                $table->timestamps();
            });

            return;
        }

        // Table exists — apply safe alterations only (guard each change).
        Schema::table('ekstrakurikulers', function (Blueprint $table) {
            if (Schema::hasColumn('ekstrakurikulers', 'nama_eskul')) {
                // Rename existing column if present
                $table->renameColumn('nama_eskul', 'nama');
            }

            // Add new columns if they don't exist (avoid using ->after() to be safer)
            if (!Schema::hasColumn('ekstrakurikulers', 'icon')) {
                $table->string('icon')->default('fas fa-star');
            }

            if (!Schema::hasColumn('ekstrakurikulers', 'thumbnail')) {
                $table->string('thumbnail')->nullable();
            }

            if (!Schema::hasColumn('ekstrakurikulers', 'pembina')) {
                $table->string('pembina')->nullable();
            }

            if (!Schema::hasColumn('ekstrakurikulers', 'jadwal')) {
                $table->string('jadwal')->nullable();
            }

            if (!Schema::hasColumn('ekstrakurikulers', 'tags')) {
                $table->json('tags')->nullable();
            }

            if (!Schema::hasColumn('ekstrakurikulers', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }

            // Avoid using ->change() here (requires doctrine/dbal). Skipping nullable->not-null conversion.

            // Drop fotos column if exists
            if (Schema::hasColumn('ekstrakurikulers', 'fotos')) {
                $table->dropColumn('fotos');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('ekstrakurikulers')) {
            return;
        }

        Schema::table('ekstrakurikulers', function (Blueprint $table) {
            // Reverse the changes where possible (guard columns)
            if (Schema::hasColumn('ekstrakurikulers', 'nama')) {
                $table->renameColumn('nama', 'nama_eskul');
            }

            $drop = [];
            foreach (['icon', 'thumbnail', 'pembina', 'jadwal', 'tags', 'is_active'] as $c) {
                if (Schema::hasColumn('ekstrakurikulers', $c)) {
                    $drop[] = $c;
                }
            }

            if (!empty($drop)) {
                $table->dropColumn($drop);
            }

            // Avoid change() in down as well
            if (!Schema::hasColumn('ekstrakurikulers', 'fotos')) {
                $table->json('fotos')->nullable();
            }
        });
    }
};
