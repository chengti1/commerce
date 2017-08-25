<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->float('fixed')->default(0);
            $table->integer('percentage')->default(0);
            $table->float('maximum')->default(0);
            $table->integer('sub_cat')->unsigned();
            $table->timestamps();
            $table->foreign('sub_cat')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_commissions');
    }
}
