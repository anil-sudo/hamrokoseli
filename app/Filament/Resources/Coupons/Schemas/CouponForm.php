<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vendor_id')
                    ->relationship('vendor', 'id')
                    ->default(null),
                TextInput::make('code')
                    ->required(),
                Select::make('discount_type')
                    ->options(['percentage' => 'Percentage', 'fixed_amount' => 'Fixed amount'])
                    ->required(),
                TextInput::make('discount_value')
                    ->required()
                    ->numeric(),
                TextInput::make('min_order')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('max_uses')
                    ->numeric()
                    ->default(null),
                TextInput::make('used_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('expires_at'),
                Select::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive', 'expired' => 'Expired'])
                    ->default('active')
                    ->required(),
            ]);
    }
}
