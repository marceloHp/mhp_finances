<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Filament\Resources\AddressResource\RelationManagers;
use App\Models\Address;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $label = 'Endereços';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->translateLabel()->label('Endereço'),
                Forms\Components\TextInput::make('neighborhood')
                    ->required()
                    ->translateLabel()->label('Bairro'),
                Forms\Components\TextInput::make('address_number')
                    ->required()
                    ->translateLabel()->label('Número'),
                Forms\Components\TextInput::make('complement')
                    ->required()
                    ->translateLabel()->label('Complemento'),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->translateLabel()->label('Cidade'),
                Forms\Components\TextInput::make('postal_code')
                ->translateLabel()->label('CEP'),
                Forms\Components\Toggle::make('main')
                    ->required()->translateLabel()->label('Principal'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('main')
                    ->boolean()->translateLabel()->label('Principal'),
                Tables\Columns\TextColumn::make('address')->translateLabel()->label('Endereço'),
                Tables\Columns\TextColumn::make('neighborhood')->translateLabel()->label('Bairro'),
                Tables\Columns\TextColumn::make('address_number')->translateLabel()->label('Número'),
                Tables\Columns\TextColumn::make('complement')->translateLabel()->label('Complemento'),
                Tables\Columns\TextColumn::make('city')->translateLabel()->label('Cidade'),
                Tables\Columns\TextColumn::make('postal_code')->translateLabel()->label('CEP'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->translateLabel()->label('Data de criação'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->translateLabel()->label('Data de atualização'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
