<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Setting Key')
                    ->disabled()
                    ->required(),
                
                DateTimePicker::make('value')
                    ->label('Setting Value (Date/Time)')
                    ->required()
                    ->placeholder('Select target date/time')
                    ->displayFormat('Y-m-d H:i:s')
                    ->native(false),
            ]);
    }
}
