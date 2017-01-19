<?php

use Illuminate\Database\Seeder;

class ListOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	$arrayDefaultOptions = array('property_type' => 'Property Type','market_area' => 'Market Area','management' => 'Management','building_type' => 'Building Type');
     	foreach ($arrayDefaultOptions as $key => $name) {
     		DB::table('list_options')->insert([
	            'key' => $key,
	            'name' => $name,
	            'parent_id' => 0,
	            'default' => 1
	        ]);
     	}
       
    }
}
