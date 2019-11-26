<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storeimport', function (Blueprint $table) {
            $table->increments('id');
            $table->char('manhapkho', '50')->nullable($value = 'true');
            $table->string('tendetaithinghiem')->nullable($value = 'true');
            $table->unsignedInteger('caytrong_id');
            $table->unsignedInteger('vusanxuat_id');
            $table->date('ngaynhapkho')->nullable($value = 'true');
            $table->string('ghichu')->nullable($value = 'true');
            $table->timestamps();

            $table->foreign('caytrong_id')->references('id')->on('caytrong');
            $table->foreign('vusanxuat_id')->references('id')->on('vusanxuat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storeimport');
    }
}
