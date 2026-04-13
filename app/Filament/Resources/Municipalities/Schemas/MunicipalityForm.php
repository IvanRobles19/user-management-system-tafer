<?php

namespace App\Filament\Resources\Municipalities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MunicipalityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('state_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
