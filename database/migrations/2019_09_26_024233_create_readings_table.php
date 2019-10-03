<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meter_data_id');
            $table->bigInteger('previous_meter_data_id');
            $table->bigInteger('sequence_id');
            $table->string('location')->index();
            $table->string('meter_id')->index();
            $table->double('current_wh_total');
            $table->dateTime('current_datetime');
            $table->double('previous_wh_total')->nullable();
            $table->dateTime('previous_datetime')->nullable();
            $table->decimal('diff_wh_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readings');
    }
}
