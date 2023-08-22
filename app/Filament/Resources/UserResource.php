<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $label = 'Usuários';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')->label('ID')->disabled(),
                TextInput::make('name')
                    ->required()->translateLabel()->label('Nome'),
                TextInput::make('email')
                    ->email()
                    ->required()->translateLabel()->label('E-mail'),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->translateLabel()->label('Senha'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable()->translateLabel()->label('ID')->copyable(),
                TextColumn::make('name')->sortable()->searchable()->translateLabel()->label('Nome'),
                TextColumn::make('email')->sortable()->searchable()->translateLabel()->label('E-mail'),
                TextColumn::make('created_at')->translateLabel()->label('Criado em')
                    ->dateTime('d/m/y H:m:s'),
                TextColumn::make('updated_at')->translateLabel()->label('Última atualização')
                    ->dateTime('d/m/y H:m:s'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->translateLabel()->label('Editar'),
                DeleteAction::make()->translateLabel()->label('Excluir'),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
