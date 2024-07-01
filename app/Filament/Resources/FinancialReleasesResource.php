<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialReleasesResource\Pages;
use App\Filament\Resources\FinancialReleasesResource\RelationManagers;
use App\Filament\Support\FinancialReleases\Origin;
use App\Models\FinancialReleases;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;

class FinancialReleasesResource extends Resource
{
    protected static ?string $model = FinancialReleases::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $label = 'Lançamentos financeiros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\Select::make('people_id')
                        ->required()->relationship('people', 'name')
                        ->searchable()->label('Pessoa')->preload(),
                    Forms\Components\DatePicker::make('financial_date')->label('Data do lançamento'),
                    Forms\Components\TextInput::make('description')
                        ->required()->label('Descrição do lançamento'),
                    Forms\Components\Select::make('origin')->label('Origem')->options([
                        'cash_entry' => 'Entrada',
                        'cash_out' => 'Saída',
                    ]),
                    Forms\Components\Select::make('status')->label('Status')->options([
                        'paid' => 'Quitado',
                        'pending' => 'Pendente',
                    ])->default('pending'),

                    Forms\Components\Select::make('financial_releases_categories_id')->searchable()->preload()
                        ->required()->relationship('financialReleasesCategories', 'name')->label('Categoria'),
                    Forms\Components\TextInput::make('value')
                        ->required()->label('Valor (R$)')
                        ->currencyMask('.', ',', 2)
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->copyable()->copyMessage('ID copiado')->copyMessageDuration(400),
                Tables\Columns\TextColumn::make('people.name')->label('Pessoa'),
                Tables\Columns\SelectColumn::make('origin')->options(Origin::class)->label('Origem')->columnSpan('full')->disabled(),
                Tables\Columns\TextColumn::make('financialReleasesCategories.name')->label('Categoria'),
                Tables\Columns\TextColumn::make('description')->label('Descrição do lançamento'),
                Tables\Columns\TextColumn::make('financial_date')->label('Data do lançamento')->dateTime('d/m/y'),
                Tables\Columns\TextColumn::make('description')->label('Descrição do lançamento'),
                Tables\Columns\SelectColumn::make('origin')->options(Origin::class)->label('Origem')->columnSpan('full')->disabled(),
                Tables\Columns\TextColumn::make('recipient')->label('Beneficiário'),
                Tables\Columns\TextColumn::make('value')->label('Valor (R$)')->formatStateUsing(fn ($state) => 'R$ '.number_format($state, 2, ',', '.'))
                    ->summarize(Sum::make()->numeric()->label('Total (R$)')->money('BRL')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:m:s')->label('Última atualização'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('origin')->options([
                    'cash_entry' => 'Entrada',
                    'cash_out' => 'Saída',
                ])->label('Origem')->multiple(),
                Tables\Filters\SelectFilter::make('financial_releases_categories_id')->relationship('financialReleasesCategories', 'name')->multiple()->preload()
            ])
            ->actions([
                Tables\Actions\EditAction::make()->translateLabel()->label('Editar'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->translateLabel()->label('Excluir'),
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
            'index' => Pages\ListFinancialReleases::route('/'),
            'create' => Pages\CreateFinancialReleases::route('/create'),
            'edit' => Pages\EditFinancialReleases::route('/{record}/edit'),
        ];
    }

}
