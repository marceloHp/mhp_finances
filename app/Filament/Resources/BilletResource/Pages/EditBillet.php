<?php

namespace App\Filament\Resources\BilletResource\Pages;

use App\Filament\Resources\BilletResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBillet extends EditRecord
{
    protected static string $resource = BilletResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
