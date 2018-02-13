<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('id_pay',100);
            $table->string('payment_method',20);
            $table->string('state',20);
            $table->integer('price');
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
        Schema::drop('pay_infos');
    }
}
