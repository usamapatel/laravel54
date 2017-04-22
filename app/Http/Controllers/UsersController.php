<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon as Carbon;
use App\Models\User;
use DB;
use Validator;
use View;


class UsersController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'User';
        $this->request= $request;
        View::share ( 'title', $this->title );
    }

    public function __destruct()
    {
        unset($this->title);
    }
    public function init()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    public function getUserData() 
    {
        $request = $this->request->all();
        $users=DB::table('users')->select("*", DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        if(isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        } else {
            $sortby = 'users.id';
            $sorttype = 'desc';
        }
        $users->orderBy($sortby, $sorttype);

        // $users->where('users.deleted_at', '=', null);
        if(isset($request['name']) && trim($request['name']) != '')
            $users->where('users.name', 'like', "%" . $request['name'] . "%");


        if(isset($request['email']) && trim($request['email']) != '')
            $users->where('users.email', 'like', "%" . $request['email'] . "%");


        $usersList=array();

        if(!array_key_exists('pagination', $request)) {
            $users = $users->paginate($request['pagination_length']);
            $usersList = $users;
        } else {
            $usersList['total'] = $users->count();
            $usersList['data'] = $users->get();
        }
        
        $response = $usersList; 
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->init();
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->get('password'));
        $users->banned_at = Carbon::parse($request->banned_at)->format('Y-m-d H:i:s');
        $users->save(); 
        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->init();
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->banned_at = Carbon::parse($request->banned_at)->format('Y-m-d H:i:s');
        $users->save(); 
        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::where('id', $id)->delete()) {
            flash()->success(config('config-variables.flash_messages.dataDeleted'));
        }else{
            flash()->error(config('config-variables.flash_messages.dataNotDeleted'));
        }
        return redirect()->route('users.index');
    }
}
