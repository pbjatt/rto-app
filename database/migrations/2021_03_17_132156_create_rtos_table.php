<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtos', function (Blueprint $table) {
            $table->id();
            $table->string('rto_num');
            $table->string('name');
            $table->string('state');
            $table->string('private_car');
            $table->string('two_w');    
            $table->string('pcv_texi');
            $table->string('commercial_vehicle');
            $table->string('kerala_cess');
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
        Schema::dropIfExists('rtos');
    }
}
