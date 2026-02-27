<?php

use Illuminate\Database\Seeder;
use iteos\Models\EmployeeAttendance;

class AttendanceTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeAttendance::create([
        	'id' => '83f6b554-a17c-4ff2-9c33-eb0f289f6154',
        	'employee_id' => '85e59d53-6e13-4b1c-aa18-a244e0862261',
        	'working_hour' => '8.5',
        	'status_id' => '2dc764a0-f110-4985-922d-0ffb81363899',
        	'created_at' => '2020-02-11 07:42:46',
        	'updated_at' => '2020-02-11 18:42:46',
        ]);
    }
}
