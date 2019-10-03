<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HourlyReport extends Model
{
    protected $fillable = [
        'location',
        'meter_id',
        'date',
        'time',
        'hour_of_day',
        'wh_total',
        'datetime',
    ];
}
