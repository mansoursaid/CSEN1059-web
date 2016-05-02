<?php

namespace App;

use Illuminate\Support\Facades\Mail;


class MailNotification {

    public static function mailClaim($users, $ticket) {
        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::send('mails.claim', ['id' => $ticket->id], function($message) use ($emails)
        {
            $message->to($emails)->subject('Claim a ticket');
        });

    }

    public static function mailClose($users, $ticket) {
        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::send('mails.close', ['id' => $ticket->id], function($message) use ($emails)
        {
            $message->to($emails)->subject('Close a ticket');
        });

    }

    public static function mailCannotClaim($users, $ticket) {
        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::send('mails.cannotclaim', ['id' => $ticket->id], function($message) use ($emails)
        {
            $message->to($emails)->subject('Can not claim a ticket');
        });

    }

    public static function mailInvitation($users, $name, $email, $password, $type) {

        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }
        error_log($name);
        error_log(">>>>>>>>>>>>>>>>>");

        Mail::send('mails.mailInvitation', ['name' => $name, 'email' => $email,
                'password' => $password, 'type' => $type],
            function($message) use ($emails)
            {
                $message->to($emails)->subject('Welcome Abroad');
            });

        error_log("eeeeeeeeeeeeeeeee");

    }

}
