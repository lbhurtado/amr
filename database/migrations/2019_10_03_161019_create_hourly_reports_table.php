<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourlyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourly_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location');
            $table->string('meter_id');
            $table->date('date');
            $table->time('time');
            $table->string('hour_of_day');
            $table->double('wh_total');
            $table->dateTime('datetime');
            $table->bigInteger('meter_data_id');
            $table->timestamps();
            $table->unique(['meter_id', 'date', 'hour_of_day']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hourly_reports');
    }
}
