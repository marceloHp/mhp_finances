<?php

namespace App\Filament\Resources\FinancialReleasesResource\Pages;

use App\Filament\Resources\FinancialReleasesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\View\View;

class EditFinancialReleases extends EditRecord
{
    protected static string $resource = FinancialReleasesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()->translateLabel()->label('Exluir'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Lançamento atualizado.';
    }
}
