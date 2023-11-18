<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Helpers\GlobalHelper;
use App\Helpers\ResponseHelper;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $role): Response
    {
        if(!auth()->check()){
//            abort(401);
            return ResponseHelper::error('Authentication Required', 401);
        }

        if (!User::current()->hasRole(RoleEnum::from($role))) {
//            abort(403, "Permission denied");
            return ResponseHelper::error('Permission denied', 403);
        }

        return $next($request);
    }
}
