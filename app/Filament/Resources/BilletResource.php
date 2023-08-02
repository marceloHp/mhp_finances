<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BilletResource\Pages;
use App\Filament\Resources\BilletResource\RelationManagers;
use App\Models\Billet;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class BilletResource extends Resource
{
    protected static ?string $model = Billet::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $label = 'Boletos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('people_id')
                    ->required()
                    ->relationship('people', 'name')
                    ->searchable()
                    ->translateLabel()
                    ->label('Pessoa'),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name')
                    ->translateLabel()
                    ->label('Usuário')
                    ->searchable(),
//                ->default(auth()->user()),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options(['pending' => 'Pendente', 'partial_pending' => 'Parcialmente pendente', 'paid' => "Quitado", 'canceled' => 'Cancelado'])
                    ->default('pending'),
                Forms\Components\DateTimePicker::make('release_date')
                    ->required()->translateLabel()->label('Data de Lançamento'),
                Forms\Components\DateTimePicker::make('paid_date')
                    ->required()->translateLabel()->label('Data de pagamento'),
                Forms\Components\TextInput::make('installments')
                    ->required()->translateLabel()->label('Parcelas'),
                Forms\Components\TextInput::make('total_value')
                    ->required()->translateLabel()->label('Valor total (R$)')
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => ($set('pending_value', $state)))
                    ->mask(fn(Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2)
                        ->thousandsSeparator('')
                        ->padFractionalZeros()),
                Forms\Components\TextInput::make('pending_value')
                    ->required()->translateLabel()->label('Valor pendente (R$)')
                    ->disabled()
                    ->mask(fn(Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2)
                        ->padFractionalZeros()),
                Forms\Components\TextInput::make('paid_value')
                    ->translateLabel()
                    ->label('Valor pago (R$)')
                    ->disabled()
                    ->default('0')
                    ->mask(fn(Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2)
                        ->padFractionalZeros()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('people.name')
                    ->translateLabel()->label('Pessoa'),
                Tables\Columns\TextColumn::make('user.name')
                    ->translateLabel()->label('Usuário'),
                Tables\Columns\TextColumn::make('status')
                    ->translateLabel()->label('Status')
                    ->enum(['pending' => 'Pendente', 'partial_pending' => 'Parcialmente pendente', 'paid' => "Quitado", 'canceled' => 'Cancelado']),
                Tables\Columns\TextColumn::make('release_date')
                    ->dateTime()
                    ->translateLabel()->label('Data de lançamento'),
                Tables\Columns\TextColumn::make('paid_date')
                    ->dateTime()
                    ->translateLabel()->label('Data de pagamento'),
                Tables\Columns\TextColumn::make('installments')
                    ->translateLabel()->label('Parcelas'),
                Tables\Columns\TextColumn::make('total_value')
                    ->formatStateUsing(fn(string $state): string => self::numberFormat($state))
                    ->translateLabel()->label('Valor total (R$)'),
                Tables\Columns\TextColumn::make('pending_value')
                    ->formatStateUsing(fn(string $state): string => self::numberFormat($state))
                    ->translateLabel()->label('Valor pendente (R$)'),
                Tables\Columns\TextColumn::make('paid_value')
                    ->formatStateUsing(fn(string $state): string => self::numberFormat($state))
                    ->translateLabel()->label('Valor pago (R$)'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->translateLabel()->label('Data de criação'),
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

    public static function numberFormat($number): string
    {
        return number_format($number, 2, '.', '');
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
            'index' => Pages\ListBillets::route('/'),
            'create' => Pages\CreateBillet::route('/create'),
            'edit' => Pages\EditBillet::route('/{record}/edit'),
        ];
    }
}
