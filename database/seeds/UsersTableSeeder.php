<?php

use App\Models\User;
use App\Models\Companies;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Events\CompanyRegistered;
use Carbon\Carbon as Carbon;

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
            'is_verified'        => 1,
            'verified_at'        => Carbon::now()->format('Y-m-d H:i:s'),
            'verification_token' => md5(uniqid(mt_rand(), true)),

        ], ]);

        $company = Companies::find(2);
        $user = User::find(1);

        DB::table('company_user')->truncate();
        DB::table('company_user')->insert([
        [
            'company_id' => 2,
            'user_id'    => 1,
            'is_invitation_accepted' => 1
        ], ]);

        event(new CompanyRegistered($company, $user, 'admin'));
    }
}
