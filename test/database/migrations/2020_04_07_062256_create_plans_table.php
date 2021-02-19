<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('plan_type_id');
            $table->string('name',200);
            $table->float('annual_price')->nullable();
            $table->float('monthly_price')->nullable();
            $table->tinyInteger('tax');
            $table->tinyInteger('discount');
            $table->integer('total_links');
            $table->integer('total_branded_links');
            $table->integer('total_users');
            $table->integer('total_custom_domains');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('plans');
    }
}
