<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	'category_name' => 'Electronics',
        	'parent_id' => '0',
        ]);

        DB::table('categories')->insert([
        	'category_name' => 'Clothes',
        	'parent_id' => '0',
        ]);

        DB::table('categories')->insert([
        	'category_name' => 'Computers',
        	'parent_id' => '1',
        ]);

        DB::table('categories')->insert([
        	'category_name' => 'Mobiles',
        	'parent_id' => '1',
        ]);

        DB::table('categories')->insert([
        	'category_name' => 'Clothes',
        	'parent_id' => '2',
        ]);

        DB::table('categories')->insert([
        	'category_name' => 'Shoes',
        	'parent_id' => '2',
        ]);
    }
}
