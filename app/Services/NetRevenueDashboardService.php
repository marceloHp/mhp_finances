<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class NetRevenueDashboardService
{
    public function netRevenueDashboardData()
    {
       return $this->getData();
    }

    private function getData()
    {
        $data = DB::table('financial_releases')
            ->select(
                DB::raw('strftime("%Y-%m", financial_date) as date'),
                DB::raw('SUM(CASE WHEN origin = "cash_entry" THEN value ELSE 0 END) - SUM(CASE WHEN origin = "cash_out" THEN value ELSE 0 END) as total')

            )
            ->groupBy(DB::raw('strftime("%m", financial_date)'))
            ->orderBy('mes')
            ->get();
        return $data;
    }
}
