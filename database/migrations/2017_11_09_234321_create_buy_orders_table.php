<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('buy_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_order');
            $table->double('total');
            $table->integer('buy_qualification_id')->unsigned();
            $table->foreign('buy_qualification_id')->references('id')->on('buy_qualification')->onDelete('cascade');
            $table->date('warranty_void');
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
        Schema::dropIfExists('buy_orders');
    }
}
