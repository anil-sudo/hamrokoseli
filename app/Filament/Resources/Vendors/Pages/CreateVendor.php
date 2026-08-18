<?php

namespace App\Filament\Resources\Vendors\Pages;

use App\Filament\Resources\Vendors\VendorResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateVendor extends CreateRecord
{
    protected static string $resource = VendorResource::class;

    protected function afterCreate(): void
    {
        $vendor = $this->record;
        if ($vendor->user) {
            $userUpdates = [
                'role' => 'vendor',
                'is_active' => true,
            ];

            if (! empty($this->data['password'])) {
                $userUpdates['password'] = Hash::make($this->data['password']);
            }

            $vendor->user->update($userUpdates);

            if (method_exists($vendor->user, 'assignRole')) {
                $role = Role::where('name', 'vendor')->first()
                    ?? Role::firstOrCreate(['name' => 'vendor', 'guard_name' => 'web']);
                $vendor->user->assignRole($role);
            }
        }
    }
}
