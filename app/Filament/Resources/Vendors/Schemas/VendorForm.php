<?php

namespace App\Filament\Resources\Vendors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VendorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('vendor_name')
                    ->required(),
                TextInput::make('owner_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                Textarea::make('vendor_address')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('city')
                    ->default(null),
                TextInput::make('province')
                    ->default(null),
                TextInput::make('pan_number')
                    ->default(null),
                TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'active' => 'Active', 'suspended' => 'Suspended'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
