<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVuSanXuatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vusanxuat', function (Blueprint $table) {
            $table->increments('id');
            $table->char('mavusanxuat')->nullable($value = true);
            $table->string('tenvusanxuat');
            $table->string('ghichu')->nullable($value = true);
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
        Schema::dropIfExists('vusanxuat');
    }
}
