<?php

namespace App\Http\Middleware\Admin;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminAsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //
        if (Auth::guard('web')->check() && Auth::guard('admin')->check() && session()->has('expire_time')) {
            $expireTime = session()->get('expire_time');
            if (Carbon::now()->greaterThan($expireTime)) {
                Auth::guard('web')->logout();
                session()->put('DEBUG_MODE', FALSE);
                session()->forget('expire_time');
                return redirect()->route('admin.dashboard.dashboard');
            }
            session()->put('DEBUG_MODE', TRUE);
        }

        return $next($request);
    }
}
