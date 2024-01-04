<?php

namespace App\Filament\Resources\FinancialReleasesCategoriesResource\Pages;

use App\Filament\Resources\FinancialReleasesCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFinancialReleasesCategories extends ManageRecords
{
    protected static string $resource = FinancialReleasesCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Novo'),

        ];
    }
}
