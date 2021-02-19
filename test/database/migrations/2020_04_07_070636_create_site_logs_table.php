<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_type',100);
            $table->text('description');
            $table->integer('moduleid'); //FK modules table
            $table->integer('userid'); //FK users table
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
        Schema::dropIfExists('site_logs');
    }
}
