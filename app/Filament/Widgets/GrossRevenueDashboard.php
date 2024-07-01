<?php

namespace App\Filament\Widgets;

use App\Services\GrossRevenueDashboardService;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Collection;

class GrossRevenueDashboard extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'info';

    public function getHeading(): string
    {
        return 'Faturamento bruto';
    }

    protected function getData(): array
    {
        $data = app(GrossRevenueDashboardService::class)->grossRevenueData();
        $handledData = $this->handleData($data);
        return [
            'datasets' => [
                [
                    'label' => 'Valor de entrada (R$)',
                    'data' => $handledData['total'],
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => '#36A2EB',
                ],
            ],
            'labels' => $handledData['months'],
        ];
    }

    private function handleData(Collection $data): array
    {
        $total[] = $data->map(function ($item) {
            return $item->total;
        });

        $months[] = $data->map(function ($item) {
            $date = Carbon::parse($item->financial_date);
            return $date->translatedFormat('F');
        });

        return ['total' => $total[0]->all(), 'months' => $months[0]->all()];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
