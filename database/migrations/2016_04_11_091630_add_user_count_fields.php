<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserCountFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ad_source')->after('remember_token');
            $table->integer('invite_id')->after('ad_source');
            $table->string('referrer')->after('invite_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ad_source');
            $table->dropColumn('invite_id');
            $table->dropColumn('referrer');
        });
    }
}
