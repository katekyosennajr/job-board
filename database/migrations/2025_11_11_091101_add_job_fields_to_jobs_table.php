<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'job_type')) {
                $table->string('job_type')->nullable()->after('location');
            }
            if (!Schema::hasColumn('jobs', 'category')) {
                $table->string('category')->nullable()->after('job_type');
            }
            if (!Schema::hasColumn('jobs', 'min_salary')) {
                $table->integer('min_salary')->nullable()->after('category');
            }
            if (!Schema::hasColumn('jobs', 'max_salary')) {
                $table->integer('max_salary')->nullable()->after('min_salary');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (Schema::hasColumn('jobs', 'job_type')) {
                $table->dropColumn('job_type');
            }
            if (Schema::hasColumn('jobs', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('jobs', 'min_salary')) {
                $table->dropColumn('min_salary');
            }
            if (Schema::hasColumn('jobs', 'max_salary')) {
                $table->dropColumn('max_salary');
            }
        });
    }
};
