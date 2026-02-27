<?php

use Illuminate\Database\Seeder;
use iteos\Models\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Semarang',
            'Surabaya',
            'Aceh',
            'Medan',
            'Pekanbaru',
            'Bengkulu',
            'Padang',
            'Jambi',
            'Palembang',
            'Bandar Lampung',
            'Serang',
            'Tangerang',
            'Bekasi',
            'Depok',
            'Bogor',
            'Purwakarta',
            'Cimahi',
            'Yogyakarta',
            'Solo',
        ];

        foreach($locations as $location) {
            Location::create(['city' => $location]);
        }
    }
}
