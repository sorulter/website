<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Rewards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('invited_id')->unsigned();
            $table->integer('state');
            $table->dateTime('useable_date');
            $table->string('flows_type')->default('');
            $table->integer('flows_amount')->default(0);
            $table->integer('quantity')->default(1);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('invited_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['user_id', 'invited_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rewards');
    }
}
