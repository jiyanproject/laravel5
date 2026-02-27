<?php

use Illuminate\Database\Seeder;
use iteos\Models\AttendanceTransaction;

class AttendanceTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttendanceTransaction::create([
        	'attendance_id' => '83f6b554-a17c-4ff2-9c33-eb0f289f6154',
        	'clock_in' => '2020-02-11 07:42:46',
        	'clock_out' => '2020-02-11 18:42:46',
        	'notes' => 'Attendance Seeder Test',
        	'created_at' => '2020-02-11 07:42:46',
        	'updated_at' => '2020-02-11 18:42:46',
        ]);
    }
}
