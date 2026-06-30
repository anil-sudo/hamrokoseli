<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!class_exists(Role::class)) {
            return;
        }

        foreach (['admin', 'vendor', 'user'] as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!class_exists(Role::class)) {
            return;
        }

        foreach (['admin', 'vendor', 'user'] as $roleName) {
            Role::where('name', $roleName)
                ->where('guard_name', 'web')
                ->delete();
        }
    }
};
