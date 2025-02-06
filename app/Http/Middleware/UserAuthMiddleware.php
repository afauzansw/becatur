<?php

namespace App\Http\Middleware;

use App\Utils\WebResponse;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!Auth::guard('user')->check()) {
                return WebResponse::baseJson(["message" => "Unauthorized Request"], "Unauthorized Request", 401);
            }
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return WebResponse::baseJson(["message" => "Token Invalid"], "Token Invalid", 401);
            } else if ($exception instanceof TokenExpiredException) {
                return WebResponse::baseJson(["message" => "Token Expired"], "Token Expired", 401);
            } else {
                return WebResponse::baseJson(["message" => "Unauthorized Request"], "Unauthorized Request", 401);
            }
        }

        return $next($request);
    }
}
