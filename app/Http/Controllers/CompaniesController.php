<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Companies $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Companies $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Companies           $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Companies $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
    }

    /**
     * Generate slug
     * @param  Request $request Request Object
     * @return JSON           JSON response
     */
    public function generateSlug(Request $request)
    {
        $slug = Companies::makeSlugUniqueBeforeCreate(str_slug($request->company_name));
        return $slug;
    }

    /**
     * Select company
     * @param  Request $request Request Object
     * @return JSON           JSON response
     */
    public function selectCompany(Request $request)
    {
        $companySlug = app('request')->route()->parameter('company');
        if($companySlug != 'www') 
        {
            return redirect()->route('admin.home', ['domain' => $companySlug]);
        }
        return view('auth.selectcompany');
    }
}
