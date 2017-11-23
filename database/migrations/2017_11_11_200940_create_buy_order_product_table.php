<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_order_product', function (Blueprint $table) {

            $table->integer('buy_order_id')->unsigned();
            $table->foreign('buy_order_id')->references('id')->on('buy_orders');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buy_order_product');
    }
}
