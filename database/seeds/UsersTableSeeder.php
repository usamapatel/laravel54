<?php

use Carbon\Carbon as Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->delete();
        DB::table('users')->insert([
        [
            'name'       => 'Hardik Shah',
            'email'      => 'hshah@aecordigital.com',
            'password'   => bcrypt('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ], ]);

        DB::table('company_user')->delete();
        DB::table('company_user')->insert([
        [
            'company_id' => 1,
            'user_id' => 1,
        ], ]);        
    }
}
