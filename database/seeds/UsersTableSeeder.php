<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use Faker\Factory as Faker;

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
            'name' => 'Hardik Shah',
            'email' => 'hshah@aecordigital.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]]);
    }
}
