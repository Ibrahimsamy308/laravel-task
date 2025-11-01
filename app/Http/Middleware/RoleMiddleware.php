<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::guard('api')->user();
    
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated user.',
            ], 401);
        }
    
        if ($user->type === 'admin' || (method_exists($user, 'hasRole') && $user->hasRole('admin'))) {
            return $next($request);
        }
    
        if (method_exists($user, 'hasAnyRole')) {
            if ($user->hasAnyRole($roles)) {
                return $next($request);
            }
        }
    
        if (in_array($user->type, $roles)) {
            return $next($request);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'User does not have the right roles.',
            'user_role' => $user->type ?? 'undefined',
            'allowed_roles' => $roles,
        ], 403);
    }
    
}