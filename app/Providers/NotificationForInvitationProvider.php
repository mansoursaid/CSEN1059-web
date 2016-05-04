<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Invitation;
use App\User;
use App\Ticket;

class NotificationForInvitationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        Invitation::created(function ($invitation) {

            try {

                NotificationHandler::makeNotificationForCreatingInvitation($invitation);

            } catch(\Exception $e) {
                \Session::flash('error', $e->getMessage());
            }


            return true;

        });

        Invitation::updated(function($invitation) {
            try {
                NotificationHandler::makeNotificationForUpdatingInvitation($invitation);

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
        //
    }
}
