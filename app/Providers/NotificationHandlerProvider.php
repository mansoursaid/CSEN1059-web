<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use App\NotificationHandler;
use App\User;

class NotificationHandlerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

//        Ticket::saved(function ($ticket) {
//
//            $user = $ticket->with('assigned_to')->first();
//
//            NotificationHandler::makeNotification($user, $ticket);
//
//            return true;
//
//        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {


    }
}
