<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Hapus kolom 'category' jika masih ada
            if (Schema::hasColumn('jobs', 'category')) {
                $table->dropColumn('category');
            }

            // Tambahkan kolom 'kategori' jika belum ada
            if (!Schema::hasColumn('jobs', 'kategori')) {
                $table->string('kategori', 100)->after('job_type')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Kembalikan ke semula kalau di-rollback
            if (Schema::hasColumn('jobs', 'kategori')) {
                $table->dropColumn('kategori');
            }

            if (!Schema::hasColumn('jobs', 'category')) {
                $table->string('category', 100)->nullable();
            }
        });
    }
};
