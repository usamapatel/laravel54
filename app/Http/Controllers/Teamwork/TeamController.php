<?php

namespace App\Http\Controllers\Teamwork;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Mpociot\Teamwork\Exceptions\UserNotInTeamException;
use View;

class TeamController extends Controller
{
    public $title;

    public function __construct(Request $request)
    {
        $this->title = 'Team';
        $this->request = $request;
        View::share('title', $this->title);
        parent::__construct();
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teamwork.index')
            ->with('teams', auth()->user()->teams);
    }

    /**
     * Get team data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTeamData()
    {
        $request = $this->request->all();
        $teams = DB::table('teams')
                ->where('owner_id', auth()->user()->id)
                ->select('*', DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'));

        $sortby = 'teams.id';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $teams->orderBy($sortby, $sorttype);

        if (isset($request['name']) && trim($request['name']) !== '') {
            $teams->where('teams.name', 'like', '%'.$request['name'].'%');
        }

        $teamsList = [];

        if (!array_key_exists('pagination', $request)) {
            $teams = $teams->paginate($request['pagination_length']);
            $teamsList = $teams;
        } else {
            $teamsList['total'] = $teams->count();
            $teamsList['data'] = $teams->get();
        }

        $response = $teamsList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teamwork.create');
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
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::create([
            'name'     => $request->name,
            'owner_id' => $request->user()->getKey(),
        ]);
        $request->user()->attachTeam($team);

        return redirect(route('teams.index', ['domain' => app('request')->route()->parameter('company')]));
    }

    /**
     * Switch to the given team.
     *
     * @param int $teamId
     *
     * @return \Illuminate\Http\Response
     */
    public function switchTeam($company, $teamId)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($teamId);
        try {
            auth()->user()->switchTeam($team);
        } catch (UserNotInTeamException $e) {
            abort(403);
        }

        return redirect(route('teams.index', ['domain' => app('request')->route()->parameter('company')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $teamId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $teamId)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($teamId);

        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        return view('teamwork.edit')->withTeam($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $teamId
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company, $teamId)
    {
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::findOrFail($teamId);
        $team->name = $request->name;
        $team->save();

        return redirect(route('teams.index', ['domain' => app('request')->route()->parameter('company')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $teamId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $teamId)
    {
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::findOrFail($teamId);
        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $team->delete();

        $userModel = config('teamwork.user_model');
        $userModel::where('current_team_id', $teamId)
                    ->update(['current_team_id' => null]);

        return redirect(route('teams.index', ['domain' => app('request')->route()->parameter('company')]));
    }
}
