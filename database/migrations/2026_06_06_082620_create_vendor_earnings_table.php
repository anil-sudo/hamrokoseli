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
        Schema::create('vendor_earnings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->onDelete('cascade');

            $table->foreignId('order_item_id')
                ->unique()
                ->constrained('order_items')
                ->onDelete('cascade');

            $table->decimal('gross_amount', 10, 2)->comment('Full item subtotal');
            $table->decimal('commission', 10, 2)->comment('Platform commission deducted');
            $table->decimal('net_amount', 10, 2)->comment('Amount credited to vendor');
            $table->unsignedInteger('quantity')->comment('Quantity sold');

            $table->enum('status', ['pending', 'cleared', 'on_hold'])->default('pending');

            $table->timestamps();

            // Indexes for common query patterns
            $table->index('vendor_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_earnings');
    }
};
