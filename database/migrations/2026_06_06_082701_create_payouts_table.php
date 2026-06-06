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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->onDelete('cascade');

            $table->decimal('amount', 12, 2)->comment('Total disbursed amount');
            $table->string('method', 50)->comment('Bank transfer | eSewa | Khalti');
            $table->string('transaction_id', 150)->nullable()->comment('Bank/gateway transaction ref');

            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');

            $table->timestamp('paid_at')->nullable()->comment('Disbursement timestamp');

            $table->timestamps();

            // Indexes
            $table->index('vendor_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
