<?php

namespace App\Http\Middleware;

use Auth;
use Config;
use Closure;
use Landlord;
use App\Models\Companies;

class VerifyCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Get the company slug
        $slug = $request->company;

        //If the slug is not present return 404
        if (!$slug) {
            return response()->json(['error' => 'not found'], 404);
        }

        if(Auth::check() && $slug !== "www") {
            $company = $request->user()->companies()->where('slug', $slug)->first();
        } else {
            $company = Companies::where('slug', $slug)->first();
        }

        if(!$company) {
            return response()->json(['error' => 'not found'], 404);
        }

        Landlord::addTenant('company', $company);
        Config::set('config-variables.app.subdomain', $slug);

        return $next($request);
    }
}
