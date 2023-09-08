<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeopleResource\Pages;
use App\Filament\Resources\PeopleResource\RelationManagers;
use App\Models\People;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeopleResource extends Resource
{
    protected static ?string $model = People::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Pessoa';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->translateLabel()
                    ->label('Nome completo'),
                Forms\Components\Select::make('type')
                    ->required()
                    ->translateLabel()
                    ->label('Finalidade')
                    ->options(['employee' => 'Colaborador', 'supllier' => 'Fornecedor', 'costumer' => 'Cliente'])
                    ->default('costumer'),
                Forms\Components\Select::make('people_type')
                    ->required()->translateLabel()->label('Tipo de pessoa')
                    ->options(['cpf' => 'Pessoa física', 'cnpj' => 'Pessoa júridica']),
                Forms\Components\TextInput::make('identifier')
                    ->required()
                    ->translateLabel()
                    ->label('CPF/CNPJ'),
                Forms\Components\Select::make('address_id')
                    ->required()
                    ->translateLabel()
                    ->label('Endereço')
                    ->relationship('address', 'address')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('cellphone')
                    ->tel()
                    ->required()
                    ->translateLabel()->label('Celular'),
                Forms\Components\DatePicker::make('born_date')
                    ->required()
                    ->translateLabel()
                    ->label('Data de nascimento'),
                Forms\Components\Toggle::make('active')
                    ->required()
                    ->translateLabel()
                    ->label('Ativo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('address_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('identifier'),
                Tables\Columns\TextColumn::make('people_type'),
                Tables\Columns\TextColumn::make('cellphone'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('born_date')
                    ->date(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePeople::route('/create'),
            'edit' => Pages\EditPeople::route('/{record}/edit'),
        ];
    }
}
