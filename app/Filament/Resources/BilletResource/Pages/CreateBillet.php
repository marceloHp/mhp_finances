<?php

namespace App\Filament\Resources\BilletResource\Pages;

use App\Filament\Resources\BilletResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBillet extends CreateRecord
{
    protected static string $resource = BilletResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $data['total_value'] = $data['total_value'] / $data['installments'];
        $data['pending_value'] = $data['pending_value'] / $data['installments'];
        $compare = (int) $data['installments'];
        for ($i = 2; $i <= $compare; $i++) {
            $data['installments'] = $i;
            static::getModel()::create($data);
        }
        $data['installments'] = 1;
        return static::getModel()::create($data);
    }
}
