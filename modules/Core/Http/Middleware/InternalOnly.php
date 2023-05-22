<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InternalOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the request is internal (e.g., coming from the application itself)
        if ($request->is('internal/*')) {
            return $next($request);
        }
        
        abort(403, 'Unauthorized.');
    }
}
