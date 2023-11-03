<?php

namespace App\Filament\Widgets;

use App\Models\FinancialReleases;
use App\Services\Dashboard;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class VehiclesDashboard extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'info';

    public function getHeading(): string
    {
        return 'Faturamento líquido';
    }

    protected function getData(): array
    {
        $data = app(Dashboard::class)->netRevenueData();
        return [
            'datasets' => [
                [
                    'label' => 'Valor de entrada (R$)',
                    'data' => [$data],
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => '#36A2EB',
                ],
            ],
            'labels' => ['Jan'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
