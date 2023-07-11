<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            return $this->returnType($request);
        }
        return $next($request);
    }

    public function returnType(Request $request)
    {
        if ($request->ajax()) {
            $response = [
                'state' => false,
                'status' => 200,
                'msg' => "Authetication Required.",
                'params' => ['location' => route('admin.login')],
                'callback' => 'redirect'
            ];

            $response = FacadesResponse::make($response, (200));
            $response->header('Content-Type', 'application/json');
            return $response;
        }

        return redirect()->route('admin.login');
    }
}
