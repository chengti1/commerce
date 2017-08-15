<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_categories', function (Blueprint $table) {
            $table->increments('auction_category_id');
            $table->string('auction_category_name',500);
            $table->string('status_value',1);
            $table->string('index_value',1);
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
        Schema::drop('auction_categories');
    }
}
