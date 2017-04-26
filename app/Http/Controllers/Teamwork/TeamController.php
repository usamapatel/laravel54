<?php

namespace App\Http\Controllers\Teamwork;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mpociot\Teamwork\Exceptions\UserNotInTeamException;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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