<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Sprawdzamy czy użytkownik jest zalogowany I czy jest adminem
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Brak uprawnień. Dostęp tylko dla wykładowcy/administratora.');
        }

        return $next($request);
    }
}
