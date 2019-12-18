<?php

namespace App\Http\Middleware;

use App\Model\Admin\Admin;
use App\Model\User\User;
use App\Model\Vendor\Vendor;
use Closure;
use Illuminate\Support\Facades\Redirect;

class EnsureUserIsVerified
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
        if (! $request->user() ||
            ($request->user() instanceof User &&
            ! $request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route('user.verification.notice');
        }

        if ($request->user() instanceof Admin &&
            ! $request->user()->hasVerifiedEmail()) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route('admin.verification.notice');
        }

        if ($request->user() instanceof Vendor &&
            ! $request->user()->hasVerifiedEmail()) {
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route('vendor.verification.notice');
        }


        return $next($request);
    }
}
