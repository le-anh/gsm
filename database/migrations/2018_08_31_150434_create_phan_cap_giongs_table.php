<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhanCapGiongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phancapgiong', function (Blueprint $table) {
            $table->increments('id');
            $table->char('maphancapgiong')->nullable($value = true);
            $table->char('kyhieuphancapgiong')->nullable($value = true);
            $table->string('tenphancapgiong');
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
        Schema::dropIfExists('phancapgiong');
    }
}
