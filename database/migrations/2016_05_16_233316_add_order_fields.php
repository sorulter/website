<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrderFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('amount');
            $table->float('original', 5, 2)->default(0)->after('quantity');
            $table->float('discount', 5, 2)->default(0)->after('original');
            $table->integer('product_id')->default(0)->after('discount');
            // Snapshot of product when create order.
            $table->float('unit_price', 5, 2)->default(0)->after('product_id');
            $table->string('flows_type')->default('')->after('unit_price');
            $table->integer('flows_amount')->default(0)->after('flows_type');
            // trade info.
            $table->string('trade_no')->default('')->after('flows_amount');
            $table->string('buyer_email')->default('')->after('trade_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('original');
            $table->dropColumn('discount');
            $table->dropColumn('product_id');
            $table->dropColumn('unit_price');
            $table->dropColumn('flows_type');
            $table->dropColumn('flows_amount');
        });
    }
}
