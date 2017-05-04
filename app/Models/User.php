<?php

namespace App\Models;

use Cog\Ban\Contracts\HasBans as HasBansContract;
use Cog\Ban\Traits\HasBans;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Mpociot\Teamwork\Traits\UserHasTeams;
use Skybluesofa\Followers\Traits\Followable;
use Spatie\Permission\Traits\HasRoles;
use Ufutx\LaravelComment\CanComment;
use Ufutx\LaravelFavorite\Traits\Favoriteability;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User role($roles)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasBansContract
{
    use Notifiable, HasRoles, Impersonate, CanComment, Favoriteability, Followable, HasBans, UserHasTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_id',
        'username',
        'email',
        'password',
        'verification_token',
        'is_verified',
        'verified_at',
        'is_online',
        'last_login_time',
        'is_active',
        'last_active_time',
        'is_banned',
        'banned_at',
        'banned_by',
        'timezone',
        'settings',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'verification_token', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'person_id'        => 'integer',
        'username'         => 'string',
        'email'            => 'string',
        'password'         => 'string',
        'is_verified'      => 'boolean',
        'verified_at'      => 'datetime',
        'is_online'        => 'boolean',
        'last_login_time'  => 'datetime',
        'is_active'        => 'boolean',
        'last_active_time' => 'datetime',
        'is_banned'        => 'boolean',
        'banned_at'        => 'datetime',
        'banned_by'        => 'integer',
        'timezone'         => 'string',
        'settings'         => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'verified_at',
        'last_login_time',
        'last_active_time',
        'banned_at',
    ];
}
