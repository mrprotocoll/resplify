<?php

namespace App\Http\Middleware;

use App\Enums\ReviewStatusEnum;
use App\Helpers\GlobalHelper;
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
            return GlobalHelper::error('Authentication Required', 401);
        }

        if (!User::current()->hasRole(ReviewStatusEnum::from($role))) {
//            abort(403, "Permission denied");
            return GlobalHelper::error('Permission denied', 403);
        }

        return $next($request);
    }
}
