<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterData extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'location',
        'meter_id',
        'meter_details_id',
        'meter_client_acc_no',
        'datetime',
        'vrms_a',
        'vrms_b',
        'vrms_c',
        'irms_a',
        'irms_b',
        'irms_c',
        'freq',
        'pf',
        'watt',
        'va',
        'var',
        'wh_del',
        'wh_rec',
        'wh_net',
        'wh_total',
        'varh_neg',
        'varh_pos',
        'varh_net',
        'varh_total',
        'vah_total',
        'max_rec_kw_dmd',
        'max_rec_kw_dmd_time',
        'max_del_kw_dmd',
        'max_del_kw_dmd_time',
        'max_pos_kvar_dmd',
        'max_pos_kvar_dmd_time',
        'max_neg_kvar_dmd',
        'max_neg_kvar_dmd_time',
        'v_ph_angle_a',
        'v_ph_angle_b',
        'v_ph_angle_c',
        'i_ph_angle_a',
        'i_ph_angle_b',
        'i_ph_angle_c',
        'mac_addr',
        'soft_rev',
        'relay_status'
    ];

    public function scopeInLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    public function scopeUsingMeterId($query, $meter_id)
    {
        return $query->where('meter_id', $meter_id);
    }
}
