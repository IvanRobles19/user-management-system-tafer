<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Database\Eloquent\Builder;   


class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                    Section::make('Información Personal')
                    ->description('Datos de acceso')
                    ->schema([
                        TextInput::make('name')
                        ->label('Nombre completo')
                        ->required()
                        ->maxLength(255),
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->required(),
                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minLength(8) 
                            ->hiddenOn('edit')
                            ->same('password_confirmation') 
                            ->validationMessages([
                                'same' => 'Las contraseñas no coinciden.',
                                'min' => 'La contraseña debe tener al menos 8 caracteres.',
                            ]),
                        TextInput::make('password_confirmation')
                            ->label('Confirmar Contraseña')
                            ->password()
                            ->hiddenOn('edit')
                            ->revealable()
                            ->required()
                            ->dehydrated(false),
                        
                        DateTimePicker::make('created_at')
                            ->label('Fecha de Registro')
                            ->hiddenOn('create') 
                            ->disabled() 
                            ->native(false) 
                            ->displayFormat('d/m/Y H:i'),

                        DateTimePicker::make('updated_at')
                            ->label('Última Actualización')
                            ->hiddenOn('create')
                            ->disabled()
                            ->native(false)
                            ->displayFormat('d/m/Y H:i'),
                            
                    ])               
                    ->columns(2)
                    ->columnSpanFull(),
                    
                    Section::make('Domicilio')
                        ->description('Datos del domicilio del usuario')
                        ->schema([
                            Select::make('state_id')
                                ->label('Estado')
                                 ->options(fn () => \App\Models\State::pluck('name', 'id')) 
                                ->preload()
                                ->searchable()
                                ->live()
                                ->afterStateUpdated(fn (Set $set) => $set('municipality_id', null)),
                            Select::make('municipality_id')
                                ->options(
                                    fn (Get $get) => \App\Models\Municipality::where('state_id', $get('state_id'))
                                        ->pluck('name', 'id')
                                )
                                ->label('Municipio')
                                ->searchable(),
                            TextInput::make('address')
                                ->label('Calle y número')
                                ->maxLength(255),
                            TextInput::make('postal_code')
                                ->label('Código Postal')
                                ->maxLength(5),

                    ])
                     ->columns(2)
                    ->columnSpanFull()

                          
                    
            ]);
    }
}
