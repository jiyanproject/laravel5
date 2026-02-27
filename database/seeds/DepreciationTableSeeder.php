<?php

use Illuminate\Database\Seeder;
use iteos\Models\DepreciationMethod;

class DepreciationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
        	'Straight Line',
        	'Declining Balance',
        	'Declining Balance(150%)',
        	'Declining Balance(200%)',
        	'Full Depreciation at Purchase',
        ];

        foreach($names as $name) {
            DepreciationMethod::create(['name' => $name]);
        }
    }
}
