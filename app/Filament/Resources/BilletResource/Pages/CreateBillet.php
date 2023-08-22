<?php

namespace App\Filament\Resources\BilletResource\Pages;

use App\Filament\Resources\BilletResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;

class CreateBillet extends CreateRecord
{
    protected static string $resource = BilletResource::class;

//    protected function mutateFormDataBeforeCreate(array $data): array
//    {
//        $result = [];
//        if ($data['installments'] > 1) {
//            for ($i = 1; $i <= $data['installments']; $i++) {
//                $result[] = [
//                    "people_id" => "1",
//                    "user_id" => "1",
//                    "status" => "pending",
//                    "release_date" => "2023-07-21 00:00:00",
//                    "paid_date" => "2023-07-21 00:00:00",
//                    "installments" => $i,
//                    "total_value" => $data['total_value'] / $data['installments'],
//                    "pending_value" => $data['total_value'] / $data['installments'],
//                    "paid_value" => "0",
//                ];
//            }
//        }
//        return $result;
//    }
//
//    protected function beforeCreate(): void
//    {
//        dd($this->data);
//    }
}
