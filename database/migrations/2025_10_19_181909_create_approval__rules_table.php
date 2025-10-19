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
        Schema::create('approval__rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->decimal('min_amount');
            $table->decimal('max_amount');
            $table->json('approval_order'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval__rules');
    }
};
