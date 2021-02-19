<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid'); //FK users table
            $table->string('title',200);
            $table->text('description');
            $table->tinyInteger('admin_status');
            $table->tinyInteger('user_status');
            $table->tinyInteger('customer_status'); 
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
        Schema::dropIfExists('site_notifications');
    }
}
