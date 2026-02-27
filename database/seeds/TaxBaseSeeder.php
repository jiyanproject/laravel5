<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaxBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_base')->insert([
        	'tax_code' => 'S0',
        	'amount_limit' => '54000000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax_base')->insert([
        	'tax_code' => 'S1',
        	'amount_limit' => '58500000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax_base')->insert([
        	'tax_code' => 'S2',
        	'amount_limit' => '63000000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax_base')->insert([
        	'tax_code' => 'S3',
        	'amount_limit' => '67500000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax_base')->insert([
        	'tax_code' => 'M0',
        	'amount_limit' => '58500000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax_base')->insert([
        	'tax_code' => 'M1',
        	'amount_limit' => '63000000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax_base')->insert([
        	'tax_code' => 'M2',
        	'amount_limit' => '67500000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('tax_base')->insert([
        	'tax_code' => 'M3',
        	'amount_limit' => '72000000',
        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
    }
}
