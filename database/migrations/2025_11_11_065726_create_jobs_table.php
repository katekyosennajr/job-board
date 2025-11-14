<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('job_type'); 
            $table->string('kategori'); 
            $table->decimal('min_salary', 15, 2)->nullable();
            $table->decimal('max_salary', 15, 2)->nullable();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('pending');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
