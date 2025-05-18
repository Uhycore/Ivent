<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
       

        if ($user && $this->checkRole($user->role_id, $role)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak.');
    }

    protected function checkRole($roleId, $role)
    {
        return match ($role) {
            'admin' => $roleId == 1,
            'pengguna' => $roleId == 2,
            default => false,
        };
    }
}
