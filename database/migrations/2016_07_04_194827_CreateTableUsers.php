<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(blueprint $table){
            $table->increments('user_id');
            $table->string('user_type',500);
            $table->string('email',100);
            $table->string('first_name',500);
            $table->string('last_name',500);
            $table->string('company',500);
            $table->string('mobile_number',100);
            $table->string('address1',500);
            $table->string('address2',500);
            $table->string('country',500);
            $table->string('postal_code',500);
            $table->string('region',500);
            $table->string('password',500);
            $table->string('paypal_email',500);
            $table->string('payment_method',500);
            $table->string('newsletter',500);
            $table->string('confirm_code',500)->nullable();
            $table->string('confirmed')->default('0');
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
        Schema::drop('users');
    }
}
