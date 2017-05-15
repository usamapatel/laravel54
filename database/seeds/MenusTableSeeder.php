<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->delete();
        DB::table('menus')->insert([
        [
            'company_id' => 1,
            'name'       => 'Sidebar',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ],
        ]);
    }
}
