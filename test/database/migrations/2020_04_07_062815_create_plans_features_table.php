<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heading',150);
            $table->mediumText('title');
            $table->mediumText('short_description');
            $table->string('feature_type',100);
            $table->text('feature_text');
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
        Schema::dropIfExists('plans_features');
    }
}
