<?php

use Illuminate\Database\Seeder;
use iteos\Models\Province;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            'Aceh',
            'Bali',
            'Bangka Belitung',
            'Banten',
            'Bengkulu',
            'Gorontalo',
            'Jakarta',
            'Jambi',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'Kalimantan Barat',
            'Kalimantan Selatan',
            'Kalimantan Tengah',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Kepulauan Riau',
            'Lampung',
            'Maluku Utara',
            'Maluku',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Papua Barat',
            'Papua',
            'Riau',
            'Sulawesi Selatan',
            'Sulawesi Tengah',
            'Sulawesi Tenggara',
            'Sulawesi Utara',
            'Sumatra Barat',
            'Sumatra Selatan',
            'Sumatra Utara',
            'Yogyakarta',
        ];

        foreach($provinces as $province) {
            Province::create(['province_name' => $province]);
        }
    }
}
