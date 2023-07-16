<?php

namespace App\Filament\Resources\FinancialReleasesResource\Pages;

use App\Filament\Resources\FinancialReleasesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinancialReleases extends ListRecords
{
    protected static string $resource = FinancialReleasesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->translateLabel()->label('Novo'),
        ];
    }
}
