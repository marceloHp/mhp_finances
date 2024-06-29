<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Facades\DB;

class Dashboard
{
    public function netRevenueData(): \Illuminate\Support\Collection
    {
        $data = DB::table('financial_releases')
            ->select(
                DB::raw('financial_date'),
                DB::raw('SUM(value) as total')
            )
            ->where('origin', '=', 'cash_entry')
            ->groupBy(DB::raw('strftime("%m", financial_date)'))
            ->orderBy('mes')
            ->get();
        return $data;
    }

}
