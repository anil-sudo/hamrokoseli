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
        Schema::create('vendor_reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('vendor_id')
                  ->constrained('vendors')
                  ->onDelete('cascade');

            $table->tinyInteger('rating')->unsigned()->comment('Star rating 1 to 5');
            $table->text('comment')->nullable();

            $table->timestamps();

            // One review per user per vendor
            $table->unique(['user_id', 'vendor_id']);

            // Indexes for common query patterns
            $table->index('vendor_id');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_reviews');
    }
};