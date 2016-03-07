<?php

use Illuminate\Database\Migrations\Migration;

class CreateLogsTables extends Migration
{
    private $tables_suffix = ['a', 'b', 'c', 'd', 'e'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables_suffix as $suffix) {
            Schema::create('logs_' . $suffix, function ($table) {
                $table->integer('user_id')->unsigned();
                $table->integer('flows');
                $table->bigInteger('client_ip');
                $table->string('node');
                $table->timestamp('used_at');

                $table->foreign('user_id')->references('id')->on('users');
            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables_suffix as $suffix) {
            Schema::drop('logs_' . $suffix);
        }
    }
}
