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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('tax_code', 20)->unique();
            $table->string('confirm_image');
            $table->boolean('is_confirmed')->nullable();
            $table->boolean('is_show');

            $table->string('phone', 11);
            $table->string('email', 50);
            $table->foreignId('users_id')->unique()->constrained('users');
            $table->string('title', 100);
            $table->string('logo');
            
            $table->integer('province_id');
            $table->string('address', 300);
            $table->string('description', 5000);
            $table->json('content');

            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('youtube')->nullable();
            $table->string('wikipedia')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('shop')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
