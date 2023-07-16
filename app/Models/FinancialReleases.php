<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReleases extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicle() {
        return $this->belongsTo(Vehicles::class);
    }

}
