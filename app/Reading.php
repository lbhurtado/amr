<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    protected $fillable = [
        'location',
        'meter_id',
        'current_wh_total',
        'current_datetime',
        'previous_wh_total',
        'previous_datetime',
        'diff_wh_total'
    ];

    public function getDataAttribute()
    {
        return $this->current_kw_total - $this->previous_kw_total;
    }

    public function scopeInLocation($query, $location)
    {
        return $query->where('location', $location);
    }
}
