<?php

namespace App\Http\Middleware;

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

        $company = Companies::where('slug', $slug)->first();

        if(!$company) {
            return response()->json(['error' => 'not found'], 404);
        }

        //Add the tenant
        Landlord::addTenant($company);
        Config::set('config-variable.app.subdomain', $slug);

        return $next($request);
    }
}
