<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->Increments('sp_id');
            $table->string('sp_ten');
            $table->string('sp_tenkhongdau');
            $table->string('sp_hinhanh');
            $table->integer('sp_soluong');
            $table->integer('sp_gia');
            $table->integer('sp_giacu');
            $table->integer('th_id');
            $table->text('sp_km');
            $table->text('sp_tskt');
            $table->text('sp_chitiet');
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
        Schema::dropIfExists('sanpham');
    }
}
