<?php

namespace App;

use Illuminate\Support\Facades\Mail;


class MailNotification {

    public static function mailClaim($users, $ticket) {
        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::queue('mails.claim', ['id' => $ticket->id], function($message) use ($emails)
        {
            $message->to($emails)->subject('Claim a ticket');
        });

    }

    public static function mailClose($users, $ticket) {
        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::queue('mails.close', ['id' => $ticket->id], function($message) use ($emails)
        {
            $message->to($emails)->subject('Close a ticket');
        });

    }

    public static function mailCannotClaim($users, $ticket) {
        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::queue('mails.cannotclaim', ['id' => $ticket->id], function($message) use ($emails)
        {
            $message->to($emails)->subject('Can not claim a ticket');
        });

    }

    public static function mailCreateInvitation($users, $ticketId, $time, $user2) {

        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::queue('mails.create_invitation', ['userName' => $user2->name, 'ticketId' => $ticketId, 'time' => $time],
            function($message) use ($emails)
            {
                $message->to($emails)->subject('Ticket invitation');
            });
    }


    public static function mailInvitation($users, $name, $email, $password, $type) {

        $emails = [];
        foreach ($users as $user) {
            array_push($emails, $user->email);
        }

        Mail::queue('mails.mailInvitation', ['name' => $name, 'email' => $email,
                'password' => $password, 'type' => $type],
            function($message) use ($emails)
            {
                $message->to($emails)->subject('Welcome Abroad');
            });
        }

}
