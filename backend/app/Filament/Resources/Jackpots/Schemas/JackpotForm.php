<?php

namespace App\Filament\Resources\Jackpots\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class JackpotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('organisation_id')
                    ->required()
                    ->numeric(),
                TextInput::make('created_by_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('target_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('collected_amount')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date'),
                DatePicker::make('ends_at'),
                TextInput::make('status')
                    ->required()
                    ->default('open'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
