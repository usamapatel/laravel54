<?php

namespace App\Http\Controllers\Auth;

use App\Events\CompanyRegistered;
use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\CompanyUser;
use App\Models\Person;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'company_name'     => 'required|max:255',
            'first_name'       => 'required|max:60',
            'email'            => 'required|email|max:255|unique:users',
            'username'         => 'required|max:60|unique:users',
            'password'         => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('company.select', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $person = Person::create([
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'display_name'  => $data['username'],
                'primary_email' => $data['email'],
        ]);
        $company = Companies::create([
                'name'  => $data['company_name'],
        ]);

        $user = User::create([
            'person_id'          => $person->id,
            'username'           => $data['username'],
            'email'              => $data['email'],
            'password'           => bcrypt($data['password']),
            'verification_token' => md5(uniqid(mt_rand(), true)),
        ]);

        $companyUser = CompanyUser::create([
            'user_id'       => $user->id,
            'company_id'    => $company->id,
        ]);

        event(new CompanyRegistered($company, $user));

        return $user;
    }
}
