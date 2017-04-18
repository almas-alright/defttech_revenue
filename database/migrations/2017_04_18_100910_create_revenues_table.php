<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('entry_for');
            $table->float('desktop_spend', 8, 2);
            $table->float('desktop_mod', 8, 2);
            $table->float('mobile_spend', 8, 2);
            $table->float('mobile_mod', 8, 2);
            $table->boolean('status');
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
        Schema::dropIfExists('revenues');
    }
}
