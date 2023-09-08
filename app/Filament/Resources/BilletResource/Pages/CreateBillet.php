<?php

namespace App\Filament\Resources\BilletResource\Pages;

use App\Filament\Resources\BilletResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;

class CreateBillet extends CreateRecord
{
    protected static string $resource = BilletResource::class;

}
