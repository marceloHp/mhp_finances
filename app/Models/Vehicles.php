<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function people() {
        return $this->belongsTo(People::class);
    }
}
