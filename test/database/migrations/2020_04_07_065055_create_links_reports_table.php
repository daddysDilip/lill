<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid'); //FK - users table
            $table->integer('link_id'); //FK - user links table
            $table->dateTime('click_date_time');
            $table->ipAddress('ip_address');
            $table->mediumText('location');
            $table->string('click_type',50);
            $table->string('click_social_platform',100);
            $table->string('click_browser',100);
            $table->string('device_type',100);
            $table->string('click_platform_os',100);
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
        Schema::dropIfExists('links_reports');
    }
}
