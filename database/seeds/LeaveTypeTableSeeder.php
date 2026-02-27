<?php

use Illuminate\Database\Seeder;
use iteos\Models\LeaveType;

class LeaveTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leaves = [
            'Sakit Dengan Surat Dokter',
            'Perjalanan Dinas',
            'Cuti Ibadah',
            'Izin',
            'Izin Keadaan Kahar (Force Majeur)',
            'Cuti Tahunan',
        ];

        foreach ($leaves as $leave) {
            LeaveType::create(['leave_name' => $leave]);
        }
    }
}
