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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable()->after('email');
        });

        Schema::table('candidate_profiles', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('user_id');
        });

        Schema::table('company_profiles', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo_path');
        });

        Schema::table('candidate_profiles', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
        });

        Schema::table('company_profiles', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
        });
    }
};
