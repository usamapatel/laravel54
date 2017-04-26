You have been invited to join team {{ $team->name }}.<br>
Click here to join: <a href="{{ route('teams.accept_invite', ['domain' => app('request')->route()->parameter('company'), 'token' => $invite->accept_token]) }}">{{ route('teams.accept_invite', ['domain' => app('request')->route()->parameter('company'), 'token' => $invite->accept_token]) }}</a>
