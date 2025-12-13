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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->integer('salary_min');
            $table->integer('salary_max')->nullable();
            $table->json('content');
            $table->date('expired_time')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_confirmed')->nullable();
            $table->integer('quantity');
            $table->string('description', 5000);
            $table->integer('experience');
            $table->json('vector')->nullable();

            $table->foreignId('job_company_id')->constrained('job_companies')->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained('job_types')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
