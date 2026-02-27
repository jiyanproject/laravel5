<?php

use Illuminate\Database\Seeder;
use iteos\Models\SexType;

class SexTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Male',
            'Female',
        ];

        foreach($types as $type) {
            SexType::create(['sex_type' => $type]);
        }
    }
}
