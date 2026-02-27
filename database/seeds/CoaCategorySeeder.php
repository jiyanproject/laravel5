<?php

use Illuminate\Database\Seeder;
use iteos\Models\CoaCategory;

class CoaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
        	'Current Asset',
        	'Fixed Asset',
        	'Current Liability',
        	'Revenue',
        	'Expense'
        ];

        foreach($categories as $category) {
            CoaCategory::create(['category_name' => $category]);
        }
    }
}
