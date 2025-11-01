<?php

namespace App\Filament\Resources\Jackpots;

use App\Filament\Resources\Jackpots\Pages\CreateJackpot;
use App\Filament\Resources\Jackpots\Pages\EditJackpot;
use App\Filament\Resources\Jackpots\Pages\ListJackpots;
use App\Filament\Resources\Jackpots\Schemas\JackpotForm;
use App\Filament\Resources\Jackpots\Tables\JackpotsTable;
use App\Models\Jackpot;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JackpotResource extends Resource
{
    protected static ?string $model = Jackpot::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return JackpotForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JackpotsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJackpots::route('/'),
            'create' => CreateJackpot::route('/create'),
            'edit' => EditJackpot::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
