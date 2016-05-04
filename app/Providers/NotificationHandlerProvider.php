<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use App\NotificationHandler;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;

class NotificationHandlerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        Ticket::saved(function ($ticket) {

            try {
                $user = \App\User::findOrFail($ticket->assigned_to);
                NotificationHandler::makeNotification($user, $ticket);
            } catch(ModelNotFoundException $e) {
                \Session::flash('error', $e->getMessage());
            } catch(\Exception $e) {
                \Session::flash('error', $e->getMessage());
            }


            return true;

        });

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
