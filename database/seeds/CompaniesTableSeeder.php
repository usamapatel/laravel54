<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->delete();
        DB::table('companies')->insert([
        [
            'name'       => 'www',
            'slug'       => 'www',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        [
            'name'       => 'test',
            'slug'       => 'test',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        ]);
    }
}
