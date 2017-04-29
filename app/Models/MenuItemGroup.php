<?php

namespace App\Models;

use App\Models\Basemodel as Model;

class MenuItemGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_item_group';

    public $timestamps = false;
}
