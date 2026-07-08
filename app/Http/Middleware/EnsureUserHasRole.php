<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     * @param mixed                         $role
     */
    public function handle(Request $request, \Closure $next, ...$role): Response
    {
        abort_unless(in_array(auth()->user()->role, $role), 403, 'You do not have permission to access this request.');

        // abort_if(auth()->user()->role != $role, 403, 'You do not have permission to access this request.');

        /* if (auth()->user()->role != $role) {
            abort(403, 'You do not have permission to access this request.');
        } */

        return $next($request);
    }
}
