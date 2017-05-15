<?php

namespace App\Models;

use App\Models\Basemodel as Model;

class CompanyUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_user';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id','is_invitation_accepted',
    ];
}
