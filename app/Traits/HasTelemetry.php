<?php

namespace App\Traits;


trait HasTelemetry
{
    /** @var string */
    public $location;

    /** @var string */
    public $meter_id;

    /** @var integer */
    public $meter_details_id;

    /** @var string */
    public $meter_client_acc_no;

    /** @var string */
    public $datetime;

    /** @var float */
    public $vrms_a;

    /** @var float */
    public $vrms_b;

    /** @var float */
    public $vrms_c;

    /** @var float */
    public $irms_a;

    /** @var float */
    public $irms_b;

    /** @var float */
    public $irms_c;

    /** @var float */
    public $freq;

    /** @var float */
    public $pf;

    /** @var float */
    public $watt;

    /** @var float */
    public $va;

    /** @var float */
    public $var;

    /** @var float */
    public $wh_del;

    /** @var float */
    public $wh_rec;

    /** @var float */
    public $wh_net;

    /** @var float */
    public $wh_total;

    /** @var float */
    public $varh_neg;

    /** @var float */
    public $varh_pos;

    /** @var float */
    public $varh_net;

    /** @var float */
    public $varh_total;

    /** @var float */
    public $vah_total;

    /** @var float */
    public $max_rec_kw_dmd;

    /** @var float */
    public $max_rec_kw_dmd_time;

    /** @var float */
    public $max_del_kw_dmd;

    /** @var float */
    public $max_del_kw_dmd_time;

    /** @var float */
    public $max_pos_kvar_dmd;

    /** @var float */
    public $max_pos_kvar_dmd_time;

    /** @var float */
    public $max_neg_kvar_dmd;

    /** @var float */
    public $max_neg_kvar_dmd_time;

    /** @var float */
    public $v_ph_angle_a;

    /** @var float */
    public $v_ph_angle_b;

    /** @var float */
    public $v_ph_angle_c;

    /** @var float */
    public $i_ph_angle_a;

    /** @var float */
    public $i_ph_angle_b;

    /** @var float */
    public $i_ph_angle_c;

    /** @var float */
    public $mac_addr;

    /** @var float */
    public $soft_rev;

    /** @var float */
    public $relay_status;
}
