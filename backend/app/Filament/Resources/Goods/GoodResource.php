<?php

namespace App\Filament\Resources\Goods;

use App\Filament\Resources\Goods\Pages\CreateGood;
use App\Filament\Resources\Goods\Pages\EditGood;
use App\Filament\Resources\Goods\Pages\ListGoods;
use App\Filament\Resources\Goods\Schemas\GoodForm;
use App\Filament\Resources\Goods\Tables\GoodsTable;
use App\Models\Good;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GoodResource extends Resource
{
    protected static ?string $model = Good::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

protected static ?string $recordTitleAttribute = 'title';
protected static ?string $navigationLabel = 'Goods';

    public static function form(Schema $schema): Schema
    {
        return GoodForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GoodsTable::configure($table);
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
            'index' => ListGoods::route('/'),
            'create' => CreateGood::route('/create'),
            'edit' => EditGood::route('/{record}/edit'),
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
