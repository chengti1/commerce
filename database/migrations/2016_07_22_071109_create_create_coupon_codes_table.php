<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_coupon_codes', function (Blueprint $table) {
            $table->increments('coupon_id');
            $table->string('title',500);
            $table->string('coupon_code',500);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('is_visible_to_seller')->default(0);
            $table->integer('is_visible_to_buyer')->default(0);
            $table->integer('is_visible_to_public')->default(0);
            $table->integer('is_fixed')->default(0);
            $table->integer('is_percentage')->default(0);
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
        Schema::drop('create_coupon_codes');
    }
}
