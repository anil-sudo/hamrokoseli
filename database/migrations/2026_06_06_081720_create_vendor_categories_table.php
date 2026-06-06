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
        Schema::create('vendor_categories', function (Blueprint $table) {
            // Primary key
            $table->id();                                           // BIGINT UNSIGNED, PK, AUTO_INCREMENT

            // Foreign keys
            $table->foreignId('vendor_id')
                  ->constrained('vendors')
                  ->cascadeOnDelete();                             // FK → vendors.id, NOT NULL

            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->cascadeOnDelete();                             // FK → categories.id, NOT NULL

            // Timestamps — only created_at per schema
            $table->timestamp('created_at')
                  ->useCurrent();

            // Prevent duplicate vendor–category pairs
            $table->unique(['vendor_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_categories');
    }
};