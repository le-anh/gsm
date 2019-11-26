<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThoiGianTrongRasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thoigiantrongra', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('caytrong_id');
            $table->unsignedTinyInteger('thang')->comment('Đơn vị tính bằng tháng');
            $table->timestamps();

            $table->foreign('caytrong_id')->references('id')->on('caytrong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thoigiantrongra');
    }
}
