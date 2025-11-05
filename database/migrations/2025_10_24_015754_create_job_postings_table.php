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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('job_title', 50);
            $table->string('job_type', 50);
            $table->string('request', 50);
            $table->string('salary', 50);
            $table->json('content');
            $table->dateTime('expiredTime')->nullable();
            $table->string('email');
            $table->string('phone', 11);
            $table->boolean('is_show');
            $table->integer('province_id');
            $table->string('address', 300);

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
