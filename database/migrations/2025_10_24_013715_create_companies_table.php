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
            $table->foreignId('users_id')->unique()->constrained('users');
            $table->string('title', 100);
            $table->foreignId('business_type_id')->constrained('business_types');
            $table->string('logo');
            $table->string('website', 100);
            $table->integer('province_id');
            $table->string('address', 300);
            $table->string('description', 500);
            $table->json('content');

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
