<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class EnsureAccountIsApproved
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
        if (! $request->user() || ! $request->user()->hasApprovedAccount()) {
            return $request->expectsJson()
                ? abort(403, 'Your account is not approved.')
                : Redirect::route('approval.notice');
        }

        return $next($request);
    }
}
