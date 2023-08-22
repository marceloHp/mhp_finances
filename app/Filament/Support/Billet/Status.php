<?php

namespace App\Filament\Support\Billet;

use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel
{
    case Pending = 'pending';
    case PartialPeding = 'partial_pending';
    case Paid = 'paid';
    case Canceled = 'canceled';

    public function getLabel(): ?string
    {

        return match ($this) {
            self::Pending => 'Pendente',
            self::PartialPeding => 'Parcialmente pendente',
            self::Paid => 'Pago',
            self::Canceled => 'Cancelado',
        };
    }
}
