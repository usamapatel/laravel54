<?php

use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('menus')->truncate();
        DB::table('menus')->insert([
        [
            'company_id' => 1,
            'name' => 'Sidebar',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
