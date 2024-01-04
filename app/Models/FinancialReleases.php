<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReleases extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function people() {
        return $this->belongsTo(People::class);
    }

    public function financialReleasesCategories() {
        return $this->belongsTo(FinancialReleasesCategories::class);
    }

}
