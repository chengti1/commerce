<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->increments('achievement_id');
            $table->string('name',500);
            $table->string('description',500);
            $table->integer('bonus_points');
            $table->integer('achievement_type');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('field_value',500);
            $table->string('duration',500);
            $table->string('created_by',500);
            $table->string('updated_by',500);
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
        Schema::drop('achievements');
    }
}
