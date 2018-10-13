<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_qualifications', function (Blueprint $table) {
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
        Schema::dropIfExists('purchase_qualifications');
    }
}
