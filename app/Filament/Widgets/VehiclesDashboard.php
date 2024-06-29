<?php

namespace App\Filament\Widgets;

use App\Models\FinancialReleases;
use App\Services\Dashboard;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class VehiclesDashboard extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'info';

    public function getHeading(): string
    {
        return 'Faturamento bruto';
    }

    protected function getData(): array
    {
        $data = app(Dashboard::class)->netRevenueData();
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

    private function handleData(Collection $data): array {
        $total[] = $data->map(function ($item) {
            return $item->total;
        });


        $months[] = $data->map(function ($item) {
            $date = Carbon::parse($item->financial_date);
            return  $date->translatedFormat('F');
        });


        return ['total' => $total[0]->all(), 'months'=> $months[0]->all()];
    }

    /**
     * @throws RandomException
     */
    private function generateColors()
    {
        $red = random_int(0, 255);
        $green = random_int(0, 255);
        $blue = random_int(0, 255);
        return sprintf("#%02x%02x%02x", $red, $green, $blue);
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
