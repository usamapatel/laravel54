<?php

namespace App\Models;

use App\Models\Basemodel as Model;

class MenuItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * Relationship: widgets.
     *
     * @return
     */
    public function widgets()
    {
        return $this->hasMany('App\Models\Widget', 'menu_item_id');
    }    
}
