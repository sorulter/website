<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ModifyFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flows', function (Blueprint $table) {
            $table->bigInteger('extra')->unsigned()->after('combo_flows');
            $table->renameColumn('free', 'forever');
            $table->renameColumn('combo_flows', 'combo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flows', function (Blueprint $table) {
            $table->dropColumn('extra');
            $table->renameColumn('forever', 'free');
            $table->renameColumn('combo', 'combo_flows');
        });
    }
}
