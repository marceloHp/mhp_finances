<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Dashboard
{
    public function netRevenueData(): float|int
    {
        $data= DB::table('financial_releases')->select(['value', 'financial_date'])->where('origin', '=', 'cash_out')->groupBy('financial_date')->get();


        $dataDash = [];
        foreach ($data as $key => $value)
        {
            $dataDash['data'] =  number_format((float)$value->value, '2');
        }

        return (array_sum($dataDash));
    }

}
