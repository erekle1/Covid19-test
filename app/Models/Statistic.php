<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'confirmed', 'recovered', 'death'];

    public static $sortableFields = ['confirmed','recovered','death'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
