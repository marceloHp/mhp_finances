<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehiclesResource\Pages;
use App\Filament\Resources\VehiclesResource\RelationManagers;
use App\Models\Vehicles;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehiclesResource extends Resource
{
    protected static ?string $model = Vehicles::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $label = 'Veículos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')->disabled(true),
                Forms\Components\TextInput::make('name')
                    ->required()->translateLabel(),
                Forms\Components\TextInput::make('identifier')
                    ->required(),
                Forms\Components\TextInput::make('driver')
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('identifier'),
                Tables\Columns\TextColumn::make('driver'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/y H:m:s'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->translateLabel()->label('Editar'),
                Tables\Actions\DeleteAction::make()->translateLabel()->label('Excluir'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVehicles::route('/'),
        ];
    }
}
