<?php

use App\Models\User;
use App\Models\Companies;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Events\CompanyRegistered;

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

        DB::table('people')->truncate();
        DB::table('people')->insert([
                        [
                            'first_name'        => 'Hardik',
                            'last_name'         => 'Shah',
                            'display_name'      => 'Hardik Shah',
                            'primary_email'     => 'hshah@aecordigital.com',
                        ], ]
                    );

        DB::table('users')->truncate();
        DB::table('users')->insert([
        [
            'person_id'          => 1,
            'username'           => 'admin',
            'email'              => 'hshah@aecordigital.com',
            'password'           => bcrypt('password'),
            'verification_token' => md5(uniqid(mt_rand(), true)),

        ], ]);

        $company = Companies::find(1);
        $user = User::find(1);

        DB::table('company_user')->truncate();
        DB::table('company_user')->insert([
        [
            'company_id' => 1,
            'user_id'    => 1,
        ], ]);

        //event(new CompanyRegistered($company, $user, 'admin'));
    }
}
