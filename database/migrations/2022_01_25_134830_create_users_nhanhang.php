<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersNhanhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_nhanhang', function (Blueprint $table) {
            $table->Increments('nh_id');
            $table->string('nh_name');
            $table->string('nh_address');
            $table->string('nh_phone');
            $table->string('nh_email');
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
        Schema::dropIfExists('users_nhanhang');
    }
}
