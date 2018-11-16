<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technicians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name', 50);
            $table->string('first_name', 50)->nullable();
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->string('address',50);
            $table->string('cuit')->unique();
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
        Schema::dropIfExists('technicians');
    }
}
