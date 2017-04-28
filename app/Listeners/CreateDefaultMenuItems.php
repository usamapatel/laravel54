<?php

namespace App\Listeners;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Events\CompanyRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultMenuItems
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CompanyRegistered  $event
     * @return void
     */
    public function handle(CompanyRegistered $event)
    {
        /** create default modules */

        /*$company = $event->company;

        $menu = new Menu();
        $menu->company_id = $company->id;
        $menu->name = 'Sidebar';
        $menu->save();

        $company = $event->company;*/
    }
}
