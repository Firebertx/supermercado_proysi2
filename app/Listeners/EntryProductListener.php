<?php

namespace App\Listeners;

use App\_EntryProduct;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntryProductListener
{
    public function saved(_EntryProduct $product_entry_request)
    {
        //User::find($id)->update(['username' => $newUsername]);
    }


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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
