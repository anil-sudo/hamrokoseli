<?php

namespace App\Filament\Resources\Vendors\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class VendorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query, string $operation) => $operation === 'create'
                            ? $query->doesntHave('vendor')
                            : $query
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->unique('vendors', 'user_id', ignoreRecord: true)
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if ($state) {
                            $user = User::find($state);
                            if ($user) {
                                $set('owner_name', $user->name);
                                $set('email', $user->email);
                                if ($user->phone) {
                                    $set('phone', $user->phone);
                                }
                            }
                        }
                    })
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->unique('users', 'email'),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->minLength(8),
                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->regex('/^[0-9]{10}$/')
                            ->validationMessages([
                                'regex' => 'Phone number must contain exactly 10 digits.',
                            ]),
                    ])
                    ->createOptionUsing(function (array $data): int {
                        $user = User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => Hash::make($data['password']),
                            'phone' => $data['phone'],
                            'role' => 'vendor',
                            'is_active' => true,
                        ]);

                        if (method_exists($user, 'assignRole')) {
                            $role = Role::where('name', 'vendor')->first()
                                ?? Role::firstOrCreate(['name' => 'vendor', 'guard_name' => 'web']);
                            $user->assignRole($role);
                        }

                        return $user->id;
                    }),
                TextInput::make('vendor_name')
                    ->required(),
                TextInput::make('owner_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->unique('vendors', 'email', ignoreRecord: true),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->regex('/^[0-9]{10}$/')
                    ->validationMessages([
                        'regex' => 'Phone number must contain exactly 10 digits.',
                    ])
                    ->unique('vendors', 'phone', ignoreRecord: true),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->nullable()
                    ->minLength(8)
                    ->dehydrated(false),
                Textarea::make('vendor_address')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('city')
                    ->default(null),
                Select::make('province')
                    ->options([
                        'Bagmati Province' => 'Bagmati Province',
                        'Koshi Province' => 'Koshi Province',
                        'Gandaki Province' => 'Gandaki Province',
                        'Lumbini Province' => 'Lumbini Province',
                        'Madhesh Province' => 'Madhesh Province',
                        'Karnali Province' => 'Karnali Province',
                        'Sudurpashchim Province' => 'Sudurpashchim Province',
                    ])
                    ->searchable()
                    ->placeholder('Select a province')
                    ->default(null),
                TextInput::make('pan_number')
                    ->unique('vendors', 'pan_number', ignoreRecord: true)
                    ->default(null),
                TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(5)
                    ->default(5.0),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'active' => 'Active', 'suspended' => 'Suspended'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
