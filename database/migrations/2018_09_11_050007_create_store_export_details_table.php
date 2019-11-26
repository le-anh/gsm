<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreExportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storeexportdetail', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedInteger('storeexport_id');
            $table->unsignedInteger('chungloai_id');
            $table->char('malo', '150');
            $table->unsignedInteger('phancapgiong_id');
            $table->string('nguongoc', '150')->nullable($value = 'true');
            $table->unsignedInteger('luongdenghi')->nullable($value = 'true');
            $table->unsignedInteger('luongthatxuat')->nullable($value = 'true');
            $table->timestamps();

            $table->foreign('storeexport_id')->references('id')->on('storeexport');
            $table->foreign('chungloai_id')->references('id')->on('chungloai');
            $table->foreign('phancapgiong_id')->references('id')->on('phancapgiong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storeexportdetail');
    }
}
