<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthPlanPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_plan_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('health_zone_id')->nullable();
            $table->foreign('health_zone_id')->references('id')->on('health_zones');
            $table->unsignedBigInteger('family_size_id')->nullable();
            $table->foreign('family_size_id')->references('id')->on('family_sizes');
            $table->unsignedBigInteger('health_age_id')->nullable();
            $table->foreign('health_age_id')->references('id')->on('health_ages');
            $table->unsignedBigInteger('health_plan_id')->nullable();
            $table->foreign('health_plan_id')->references('id')->on('health_plans');
            $table->string('price');
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
        Schema::dropIfExists('health_plan_prices');
    }
}
