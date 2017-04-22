<?php

namespace App\Http\Controllers;

use DB;
use View;
use Session;
use Storage;
use JavaScript;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Role';
        $this->request= $request;
        View::share ( 'title', $this->title );
    }

    /**
     * Destory/Unset object variables.
     *
     * @return void
     */
    public function __destruct()
    {
        unset($this->title);
    }

    /**
     * Initialize variables.
     *
     * @return void
     */
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
        return view('roles.index');
    }

    /**
     * Get faq data
     *
     * @return \Illuminate\Http\Response
     */
    public function getFaqData() {
        $request = $this->request->all();
        $roles=DB::table('roles')->select("*", DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        if(isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        } else {
            $sortby = 'faq.id';
            $sorttype = 'desc';
        }
        $roles->orderBy($sortby, $sorttype);

        $roles->where('roles.deleted_at', '=', null);
        if(isset($request['question']) && trim($request['question']) != '')
            $roles->where('roles.question', 'like', "%" . $request['question'] . "%");

        $rolesList=array();

        if(!array_key_exists('pagination', $request)) {
            $roles = $roles->paginate($request['pagination_length']);
            $rolesList = $roles;
        } else {
            $rolesList['total'] = $roles->count();
            $rolesList['data'] = $roles->get();
        }

        $response = $rolesList;
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
        $role = new Role();
        $role->name = $request->name;     
        $role->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));        
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('roles.edit', compact('faq'));
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
        $faqDetail=array();
        $faqDetail['question']=$request->question;
        $faqDetail['answer']=$request->answer;
        $result = $this->rolesRepo->updateFaq($faqDetail, $id);
        flash()->success(config('config-variables.flash_messages.dataSaved'));        
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Faq::where('id', $id)->delete()) {
            flash()->success(config('config-variables.flash_messages.dataDeleted'));
        }else{
            flash()->error(config('config-variables.flash_messages.dataNotDeleted'));
        }
        return redirect()->route('roles.index');
    }
}
