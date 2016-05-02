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


class NotificationHandler
{

    public static function makeNotification($user, $ticket) {

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
            event(new NotificationsEvent("The ticket with id ". $ticket->id." has been closed. You can claim another one.", $user));
        }

        if ($mailCanNotClaim) {
            MailNotification::mailCannotClaim([$user], $ticket);
            event(new NotificationsEvent("You have 3 tickets now. You can not claim another one before closing any of them.", $user));
        }

    }







}