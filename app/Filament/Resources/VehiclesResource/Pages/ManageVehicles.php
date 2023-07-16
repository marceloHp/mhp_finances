<?php

namespace App\Filament\Resources\VehiclesResource\Pages;

use App\Filament\Resources\VehiclesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicles extends ManageRecords
{
    protected static string $resource = VehiclesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->translateLabel()->label('Novo'),
        ];
    }

}
