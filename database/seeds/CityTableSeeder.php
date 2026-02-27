<?php

use Illuminate\Database\Seeder;
use iteos\Models\City;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;

class CityTableSeeder extends SpreadsheetSeeder
{
	public function __construct()
    {
        $this->file = '/dump_db/cities.xlsx'; // specify relative to Laravel project base path
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
	    parent::run();
    }
}
