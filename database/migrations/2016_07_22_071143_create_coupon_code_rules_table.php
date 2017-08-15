<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCodeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_code_rules', function (Blueprint $table) {
            $table->increments('coupon_rule_id');
            $table->string('coupon_id',500);
            $table->float('minimum_amount');
            $table->float('maximum_amount');
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
        Schema::drop('coupon_code_rules');
    }
}
