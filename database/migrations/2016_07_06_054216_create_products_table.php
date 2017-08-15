<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name',500);
            $table->string('product_price',500);
            $table->string('display_price',500);
            $table->string('seller_id',500);
            $table->string('product_images',500);
            $table->string('product_description',500);
            $table->string('product_features',500);
            $table->string('product_condition',500);
            $table->string('product_category',500);
            $table->string('product_subcategory',500);
            $table->string('keywords',500);
            $table->string('seller_discount',500);
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
        Schema::drop('products');
    }
}