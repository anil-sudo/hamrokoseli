<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                Select::make('role')
                    ->options(['user' => 'User', 'vendor' => 'Vendor', 'admin' => 'Admin'])
                    ->default('user')
                    ->required(),
                Select::make('roles')           // ← Spatie roles field, now inside the array
                    ->label('Spatie Roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->options(Role::pluck('name', 'name'))
                    ->preload(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
