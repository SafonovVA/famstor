<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NiceArtisan
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        return redirect()->back();
    }
}
