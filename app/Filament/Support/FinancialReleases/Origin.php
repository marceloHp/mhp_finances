<?php

namespace App\Filament\Support\FinancialReleases;

use Filament\Support\Contracts\HasLabel;

enum Origin: string implements HasLabel
{
    case CashEntry = 'cash_entry';
    case CashOut = 'cash_out';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CashEntry => 'Entrada',
            self::CashOut => 'Saída',
        };
    }
}
