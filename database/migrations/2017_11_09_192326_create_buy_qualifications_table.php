<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('delivery')->unsigned()->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->integer('warranty')->unsigned()->nullable();
            $table->double('average')->unsigned()->nullable();

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
        Schema::dropIfExists('buy_qualifications');
    }
}
