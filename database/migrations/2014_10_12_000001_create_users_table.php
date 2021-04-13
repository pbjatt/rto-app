<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->enum('email_verified', ['true', 'false'])->default('false');
            $table->enum('otp_verified', ['true', 'false'])->default('false');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('otp')->nullable();
            $table->string('image')->nullable();
            $table->string('referal_code')->nullable();
            $table->string('accept_code')->nullable();
            $table->enum('termcondition', ['true', 'false'])->default('true');
            $table->enum('device_type', ['Android', 'Ios'])->nullable();
            $table->string('device_id')->nullable();
            $table->string('fcm_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
