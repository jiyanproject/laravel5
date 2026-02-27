<?php

use Illuminate\Database\Seeder;

class EducationGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education_degree')->insert([
        	'degree_name' => 'SMA'
        ]);
        DB::table('education_degree')->insert([
        	'degree_name' => 'Ahli Madya'
        ]);
        DB::table('education_degree')->insert([
        	'degree_name' => 'Sarjana'
        ]);
        DB::table('education_degree')->insert([
        	'degree_name' => 'Magister'
        ]);
        DB::table('education_degree')->insert([
        	'degree_name' => 'Doktor'
        ]);
        DB::table('education_degree')->insert([
        	'degree_name' => 'Professor'
        ]);
    }
}
