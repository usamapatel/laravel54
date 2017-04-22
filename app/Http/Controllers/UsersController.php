<?php

namespace App\Http\Controllers;

use DB;
use View;
use Validator;
use App\Models\User;
use Carbon\Carbon as Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

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
        parent::__construct();
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

    public function validateEmail(Request $request) {
        $email=$request->email;
        if ($email !== null && !empty($email)) {
            $userQuery = User::where('email', $email);  
            if ($request->id) {
                $userQuery->where("id", '!=' , $request->id);
            }
            $user=$userQuery->first();
            if ($user) {
                return "false";
            }     
        }        
         return "true";       
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
        $roles = Role::all();
        return view('users.create', compact('roles'));
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
        $user->banned_at = Carbon::parse($request->banned_at)->format('Y-m-d H:i:s');
        $user->save();
        $user->assignRole($request->get('roles'));
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
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->banned_at = Carbon::parse($request->banned_at)->format('Y-m-d H:i:s');
        $user->save();
        $user->syncRoles();
        $user->assignRole($request->get('roles'));
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
