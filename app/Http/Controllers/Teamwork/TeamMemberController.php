<?php

namespace App\Http\Controllers\Teamwork;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Mpociot\Teamwork\Facades\Teamwork;
use Mpociot\Teamwork\TeamInvite;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the members of the given team.
     *
     * @param int $teamId
     *
     * @return \Illuminate\Http\Response
     */
    public function show($teamId)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($teamId);

        return view('teamwork.members.list')->withTeam($team);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $teamId
     * @param int $userId
     *
     * @return \Illuminate\Http\Response
     *
     * @internal param int $teamId
     */
    public function destroy($teamId, $userId)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($teamId);
        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $userModel = config('teamwork.user_model');
        $user = $userModel::findOrFail($userId);
        if ($user->getKey() === auth()->user()->getKey()) {
            abort(403);
        }

        $user->detachTeam($team);

        return redirect(route('teams.index'));
    }

    /**
     * @param Request $request
     * @param int     $teamId
     *
     * @return $this
     */
    public function invite(Request $request, $teamId)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($teamId);

        if (Teamwork::hasPendingInvite($request->email, $team)) {
            return redirect()->back()->withErrors([
                'email' => 'The email address is already invited to the team.',
            ]);
        }

        Teamwork::inviteToTeam($request->email, $team, function ($invite) {
            Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
                $m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
            });
            // Send email to user
        });

        return redirect(route('teams.members.show', $team->id));
    }

    /**
     * Resend an invitation mail.
     *
     * @param $inviteId
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resendInvite($inviteId)
    {
        $invite = TeamInvite::findOrFail($inviteId);
        Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
            $m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
        });

        return redirect(route('teams.members.show', $invite->team));
    }
}
