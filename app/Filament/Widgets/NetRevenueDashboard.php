<?php

namespace App\Filament\Widgets;

use App\Services\NetRevenueDashboardService;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Collection;

class NetRevenueDashboard extends ChartWidget
{
    protected static ?string $heading = 'Faturamento líquido';

    protected function getData(): array
    {
        $data = app(NetRevenueDashboardService::class)->netRevenueDashboardData();
        $handledData = $this->handleData($data);

        return [
            'datasets' => [
                [
                    'label' => 'Valor líquido (R$)',
                    'data' => $handledData['total'],
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => '#36A2EB',
                ],
            ],
            'labels' => $handledData['months'],
        ];
    }

    private function handleData($data): array
    {
        $total[] = $data->map(function ($item) {
            return $item->total;
        });

        $months[] = $data->map(function ($item) {
            $date = Carbon::parse($item->date);
            return $date->translatedFormat('F');
        });

        return ['total' => $total[0]->all(), 'months' => $months[0]->all()];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
