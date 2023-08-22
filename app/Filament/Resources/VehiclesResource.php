<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehiclesResource\Pages;
use App\Filament\Resources\VehiclesResource\RelationManagers;
use App\Models\Vehicles;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                    ->required()->translateLabel()->label('Nome'),
                Forms\Components\TextInput::make('identifier')
                    ->required()->translateLabel()->label('Placa'),
                Forms\Components\TextInput::make('driver')
                    ->required()->translateLabel()->label('Motorista'),
                Forms\Components\Toggle::make('active')
                    ->required()->translateLabel()->label('Ativo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->translateLabel()->label('Nome'),
                Tables\Columns\TextColumn::make('identifier')->translateLabel()->label('Placa'),
                Tables\Columns\TextColumn::make('driver')->translateLabel()->label('Motorista'),
                Tables\Columns\IconColumn::make('active')->translateLabel()->label('Ativo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->translateLabel()->label('Data de criação')
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
