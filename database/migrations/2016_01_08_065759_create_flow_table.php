<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('user_id')->unsigned()->primary();
            $table->bigInteger('used')->unsigned();
            $table->bigInteger('free')->unsigned();
            $table->bigInteger('combo_flows')->unsigned();
            $table->dateTime('combo_end_date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flows');
    }
}
