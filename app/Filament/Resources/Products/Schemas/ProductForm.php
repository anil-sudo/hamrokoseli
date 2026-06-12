<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vendor_id')
                    ->relationship('vendor', 'vendor_name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'cat_name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(100)
                    ->minLength(3)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state));
                        }
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->alphaDash(),
                RichEditor::make('description')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'link',
                        'blockquote',
                        'undo',
                        'redo',
                    ])
                    ->extraAttributes(['style' => 'min-height: 160px'])
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(5)
                    ->maxSize(2048)
                    ->directory('products')
                    ->helperText('Max 5 images, 2MB each. JPG, PNG, or WebP.')
                    ->panelLayout('integrated')
                    ->extraAttributes(['style' => 'min-height: 150px;'])
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('NPR')
                    ->minValue(1)
                    ->maxValue(9999999)
                    ->step(0.01)
                    ->rules(['regex:/^\d+(\.\d{1,2})?$/']),
                TextInput::make('discount_price')
                    ->numeric()
                    ->default(null)
                    ->prefix('NPR')
                    ->minValue(1)
                    ->maxValue(9999999)
                    ->step(0.01)
                    ->rules(['regex:/^\d+(\.\d{1,2})?$/'])
                    ->lt('price'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(99999)
                    ->step(1)
                    ->suffix('units'),

                Select::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive', 'draft' => 'Draft'])
                    ->default('active')
                    ->required(),
            ]);
    }
}
