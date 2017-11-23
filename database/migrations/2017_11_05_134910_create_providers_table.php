<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email', 60)->unique();
            $table->string('phone', 30);
            $table->bigInteger('cuit')->unique();
            $table->string('address');
            $table->integer('provider_qualification_id')->unsigned()->nullable()
                ->onDelete('cascade');
            $table->timestamps();
            $table->foreign('provider_qualification_id')->references('id')->on('provider_qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
