<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Tambah kolom hanya jika belum ada
            if (!Schema::hasColumn('jobs', 'company_id')) {
                $table->foreignId('company_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->onDelete('cascade');
            }

            if (!Schema::hasColumn('jobs', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('company_id')
                    ->constrained('users')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (Schema::hasColumn('jobs', 'company_id')) {
                $table->dropConstrainedForeignId('company_id');
            }

            if (Schema::hasColumn('jobs', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
