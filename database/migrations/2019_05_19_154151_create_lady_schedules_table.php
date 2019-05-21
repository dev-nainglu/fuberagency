<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLadySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lady_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lady_id');
            $table->string('time_from')->nullable();
            $table->string('time_to')->nullable();
            $table->date('at_date');
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
        Schema::dropIfExists('lady_schedules');
    }
}
