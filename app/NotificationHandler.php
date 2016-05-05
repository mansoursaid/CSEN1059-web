<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 5/2/16
 * Time: 12:26 PM
 */

namespace App;

use App\Ticket;
use App\MailNotification;
use App\Events\NotificationsEvent;
use App\Invitation;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class NotificationHandler
{

    public static function makeNotification($user, $ticket)
    {

        $newStatus = $ticket->status;

        $ticketsOpenForUser = Ticket::where('assigned_to', $user->id)->where('status', 0);

        $ticketsInProgressForUser = Ticket::where('assigned_to', $user->id)->where('status', 1);

//        $mailClaim = false;
        $mailClose = false;
        $mailCanNotClaim = false;


        if ($newStatus == 2) {
            $mailClose = true;
        }

        if ($ticketsOpenForUser->count() + $ticketsInProgressForUser->count() >= 3) {
            $mailCanNotClaim = true;
        }

        if ($mailClose) {
            MailNotification::mailClaim([$user], $ticket);
            event(new NotificationsEvent("The ticket with id " . $ticket->id . " has been closed. You can claim another one.", $user));
        }

        if ($mailCanNotClaim) {
            MailNotification::mailCannotClaim([$user], $ticket);
            event(new NotificationsEvent("You have 3 tickets now. You can not claim another one before closing any of them.", $user));
        }

    }


    public static function makeNotificationForCreatingInvitation($invitation)
    {

        try {
            $userCreateInv = User::findOrFail($invitation->created_by);
            $userInvited = User::findOrFail($invitation->user_invited);
            $ticket = Ticket::findOrFail($invitation->ticket_id);

            MailNotification::mailCreateInvitation([$userInvited], $ticket->id, $invitation->created_at, $userCreateInv);
            event(new NotificationsEvent($userCreateInv->name.' has invited you to ticket with id '.$ticket->id.' at '.$invitation->created_at, $userInvited));



        } catch(ModelNotFoundException $e) {
            echo 'error';
        } catch(\Exception $e) {
            echo 'error';
        }



    }

//    public static function makeNotificationForUpdatingInvitation($invitation)
//    {
//
//    }


}