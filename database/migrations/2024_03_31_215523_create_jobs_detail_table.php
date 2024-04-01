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
        Schema::create('jobs_detail', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->integer('vacancy');
            $table->boolean('status')->default(false);
            $table->string('salary')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('category_job_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_job_id')->constrained()->onDelete('cascade');
            $table->longText('responsabitilies');
            $table->string('qualifications');
            $table->string('experiences');
            $table->string('company_name');
            $table->string('company_location')->nullable();
            $table->string('company_website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};