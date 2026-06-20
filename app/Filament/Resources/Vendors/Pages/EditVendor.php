<?php

namespace App\Filament\Resources\Vendors\Pages;

use App\Filament\Resources\Vendors\VendorResource;
use App\Mail\VendorApproved;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;

    protected function afterSave(): void
    {
        $currentVendor = $this->record;

        if ($currentVendor->status === 'active') {
            Mail::to($currentVendor->email)->queue(new VendorApproved($currentVendor));
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
