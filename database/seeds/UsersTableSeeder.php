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

        DB::table('people')->delete();
        $person = DB::table('people')->insert([
                                                [
                                                    'first_name'       => 'Hardik',
                                                    'last_name'     => 'Shah',
                                                    'display_name'      => 'Hardik Shah',
                                                    'primary_email' => 'hshah@aecordigital.com'
                                                ], ]
                    );

        DB::table('users')->delete();
        DB::table('users')->insert([
        [
            'person_id' => 1,
            'username' => 'admin',
            'email'      => 'hshah@aecordigital.com',
            'password'   => bcrypt('password'),
            'verification_token' => md5(uniqid(mt_rand(), true)),

        ], ]);

        DB::table('company_user')->delete();
        DB::table('company_user')->insert([
        [
            'company_id' => 1,
            'user_id' => 1,
        ], ]);        
    }
}
