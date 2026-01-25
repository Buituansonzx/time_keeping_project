<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChromeOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent', '');

        if (!str_contains($userAgent, 'Chrome')) {
            return response()->json([
                'message' => 'Chỉ được truy cập bằng Chrome'
            ], 403);
        }

        return $next($request);
    }
}
