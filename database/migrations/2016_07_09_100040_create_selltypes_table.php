<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelltypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selltypes', function (Blueprint $table) {
            $table->increments('sell_type_id');
            $table->string('sell_type',500);
            $table->string('created_by',11)->nullable();
            $table->string('updated_by',11)->nullable();
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
        Schema::drop('selltypes');
    }
}
