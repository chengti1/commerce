<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuntProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunt_products', function (Blueprint $table) {
            $table->increments('hunt_id');
            $table->string('product_name', 500);
            $table->string('product_category', 500);
            $table->string('product_subcategory', 500);
            $table->string('product_image', 500);
            $table->string('product_description', 500);
            $table->string('product_swap', 500);
            $table->string('product_keywords', 500);
            $table->string('product_price', 500);
            $table->string('created_by', 500);
            $table->string('updated_by', 500);
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
        Schema::drop('hunt_products');
    }
}
