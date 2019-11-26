<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChungLoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chungloai', function (Blueprint $table) {
            $table->increments('id');
            $table->char('machungloai')->nullable($value = true);
            $table->char('kyhieuchungloai')->nullable($value = true);
            $table->string('tenchungloai');
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
        Schema::dropIfExists('chungloai');
    }
}
