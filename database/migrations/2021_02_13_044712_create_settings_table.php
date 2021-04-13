<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->Text('facebook')->nullable();
            $table->Text('instagram')->nullable();
            $table->Text('twitter')->nullable();
            $table->Text('pintertest')->nullable();
            $table->Text('youtube')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
