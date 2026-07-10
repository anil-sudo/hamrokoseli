<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->decimal('gross_amount', 12, 2)->default(0)->after('vendor_id');
            $table->decimal('platform_fee', 12, 2)->default(0)->after('gross_amount');
            $table->text('notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->dropColumn(['gross_amount', 'platform_fee', 'notes']);
        });
    }
};
