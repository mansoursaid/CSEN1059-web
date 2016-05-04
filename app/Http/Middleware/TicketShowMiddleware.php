<?php

namespace App\Http\Middleware;

use App\Invitation;
use App\Ticket;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class TicketShowMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if ($request->is('tickets/*'))
        {
            $ticketsUrl = $request->segments();
            $ticketId = $ticketsUrl[1];

            $currentUser = Auth::user();

            $ticket = Ticket::findOrFail($ticketId);

            $assignedTo = null;

            if ($ticket->assigned_to != null) {
                $assignedTo = User::findOrFail($assignedTo);
            }

            $usersInvited = Invitation::where('ticket_id', $ticketId)->where('user_invited', $currentUser->id)->get();


            if ($currentUser->type == 0 || ($assignedTo != null && $assignedTo == $currentUser->id) || $usersInvited->count() > 0) {
                return $next($request);
            }


        } else {
            return $next($request);
        }

    }
}
