<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('phone', 20);
            $table->string('email',25);
            $table->string('address',50);
            $table->bigInteger('cuit')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidstring
     */
    public function down()
    {
        Schema::dropIfExists('tecnicos');
    }
}
