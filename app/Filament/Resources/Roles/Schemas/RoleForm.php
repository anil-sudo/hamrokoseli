<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique('roles', 'name', ignoreRecord: true),
                Select::make('guard_name')
                    ->options([
                        'web' => 'web',
                        'admin' => 'admin',
                        'vendor' => 'vendor',
                    ])
                    ->default('web')
                    ->required(),
                Select::make('permissions')
                    ->label('Permissions')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }
}
