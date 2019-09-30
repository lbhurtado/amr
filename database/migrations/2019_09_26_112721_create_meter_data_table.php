<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateMeterDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location', 30)->default('Home');
            $table->string('meter_id', 30);
            $table->integer('meter_details_id');
            $table->text('meter_client_acc_no')->nullable();
            $table->dateTime('datetime');
            $table->double('vrms_a')->default(0);
            $table->double('vrms_b')->default(0);
            $table->double('vrms_c');
            $table->double('irms_a');
            $table->double('irms_b');
            $table->double('irms_c');
            $table->double('freq');
            $table->double('pf');
            $table->double('watt');
            $table->double('va');
            $table->double('var');
            $table->double('wh_del');
            $table->double('wh_rec');
            $table->double('wh_net');
            $table->double('wh_total');
            $table->double('varh_neg');
            $table->double('varh_pos');
            $table->double('varh_net');
            $table->double('varh_total');
            $table->double('vah_total');
            $table->double('max_rec_kw_dmd');
            $table->dateTime('max_rec_kw_dmd_time')->nullable();
            $table->double('max_del_kw_dmd');
            $table->dateTime('max_del_kw_dmd_time')->nullable();
            $table->double('max_pos_kvar_dmd');
            $table->dateTime('max_pos_kvar_dmd_time')->nullable();
            $table->double('max_neg_kvar_dmd');
            $table->dateTime('max_neg_kvar_dmd_time')->nullable();
            $table->double('v_ph_angle_a')->comment('additional for sfelapco inc (JULY 23, 2018)');
            $table->double('v_ph_angle_b')->comment('additional for sfelapco inc (JULY 23, 2018)');
            $table->double('v_ph_angle_c')->comment('additional for sfelapco inc (JULY 23, 2018)');
            $table->double('i_ph_angle_a')->comment('additional for sfelapco inc (JULY 23, 2018)');
            $table->double('i_ph_angle_b')->comment('additional for sfelapco inc (JULY 23, 2018)');
            $table->double('i_ph_angle_c')->comment('additional for sfelapco inc (JULY 23, 2018)');
            $table->text('mac_addr')->nullable();
            $table->text('soft_rev')->nullable();
            $table->integer('relay_status')->default(0);
            $table->index(['meter_id', 'datetime'], 'idx_name');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meter_data');
    }
}