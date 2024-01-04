<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialReleasesCategoriesResource\Pages;
use App\Filament\Resources\FinancialReleasesCategoriesResource\RelationManagers;
use App\Models\FinancialReleasesCategories;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinancialReleasesCategoriesResource extends Resource
{
    protected static ?string $model = FinancialReleasesCategories::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Categorias de lançamentos financeiros';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->translateLabel('Categoria')->columnSpan(2),
                Forms\Components\Toggle::make('active')->translateLabel('Ativo')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->translateLabel()->label('Categoria'),
                Tables\Columns\IconColumn::make('active')->boolean()->translateLabel()->label('Ativo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFinancialReleasesCategories::route('/'),
        ];
    }
}
