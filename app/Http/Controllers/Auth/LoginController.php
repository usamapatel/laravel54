<?php

namespace App\Http\Controllers\Auth;

use Hash;
use Landlord;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);

        return redirect()->route('front.index', ['domain' => 'www'])->with('status', 'Profile updated!');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $companies = $user->companies->pluck('slug')->toArray();
                $currentCompanySlug = Landlord::getTenants()['company']->slug;
                if (!in_array($currentCompanySlug, $companies)) {
                    return false;
                }
            }
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $field = filter_var($this->request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $this->request->merge([$field => $this->request->input('login')]);

        return $field;
    }
}
