<?php

namespace App\Filament\Resources\Payouts\Pages;

use App\Filament\Resources\Payouts\PayoutResource;
use App\Models\OrderItem;
use App\Models\Payout;
use App\Models\Vendor;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListPayouts extends ListRecords
{
    protected static string $resource = PayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('process_payout')
                ->label('Process Payout')
                ->icon('heroicon-o-banknotes')
                ->color('success')
                ->form([
                    Select::make('vendor_id')
                        ->label('Vendor')
                        ->options(
                            // Only vendors who have delivered order items
                            Vendor::whereHas('orderItems', fn($q) => $q->where('status', 'delivered'))
                                ->pluck('vendor_name', 'id')
                        )
                        ->searchable()
                        ->required(),

                    Select::make('method')
                        ->label('Payment Method')
                        ->options([
                            'eSewa'         => 'eSewa',
                            'Khalti'        => 'Khalti',
                            'Bank Transfer' => 'Bank Transfer',
                            'Cash'          => 'Cash',
                        ])
                        ->required(),

                    Textarea::make('notes')
                        ->label('Notes')
                        ->rows(2)
                        ->nullable(),
                ])
                ->action(function (array $data) {
                    $gross = Payout::getTotalEarnings($data['vendor_id']);
                    $fee   = round($gross * Payout::PLATFORM_FEE_RATE, 2);
                    $net   = round($gross - $fee, 2);

                    $payout = Payout::createForVendor($data['vendor_id'], $data['method'], $data['notes'] ?? null);

                    if ($payout) {
                        Notification::make()
                            ->title('Payout Created')
                            ->body("Total Orders: Rs. {$gross} | Fee (3%): Rs. {$fee} | Vendor Gets: Rs. {$net}")
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('No Earnings Found')
                            ->body('This vendor has no delivered orders to pay out.')
                            ->warning()
                            ->send();
                    }
                })
                ->modalHeading('Process Vendor Payout')
                ->modalDescription('Sums all delivered order items for the vendor, deducts 3% platform fee, and creates a payout record.')
                ->modalSubmitActionLabel('Create Payout'),

            CreateAction::make()->label('Manual Payout'),
        ];
    }
}