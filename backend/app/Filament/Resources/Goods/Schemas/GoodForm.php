<?php

namespace App\Filament\Resources\Goods\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GoodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('good_uuid')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('state')
                    ->required()
                    ->default('used'),
                TextInput::make('type')
                    ->required()
                    ->default('donation'),
                TextInput::make('status')
                    ->required()
                    ->default('available'),
                Textarea::make('exchange_condition')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('owner_id')
                    ->required()
                    ->numeric(),
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
