<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreImportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storeimportdetail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('storeimport_id');
            $table->unsignedInteger('chungloai_id');
            $table->char('malo', '150');
            $table->unsignedInteger('phancapgiong_id');
            $table->string('nguongoc')->nullable($value = 'true');
            $table->unsignedInteger('luong')->nullable($value = 'true');
            $table->float('tylenaymam', 6, 2)->nullable($value = 'true');
            $table->timestamps();

            $table->foreign('storeimport_id')->references('id')->on('storeimport');
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
        Schema::dropIfExists('storeimportdetail');
    }
}
