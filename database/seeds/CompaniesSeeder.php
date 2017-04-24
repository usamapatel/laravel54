<?php

use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->truncate();
        DB::table('companies')->insert([
        [
            'name' => 'test',
            'slug' => 'test',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]
        ]);
    }
}
