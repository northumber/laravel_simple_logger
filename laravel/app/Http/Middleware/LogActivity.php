<?php

namespace App\Http\Middleware;
use App\Models\Log;

use Closure;
use Illuminate\Http\Request;

class LogActivity
{
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('post')) {
            Log::create([
                'user_id' => auth()->check() ? auth()->user()->id : null,
                'action' => $request->path(),
                'data' => json_encode($request->all()),
                'ip' => $request->ip(),
            ]);
        }

        return $next($request);
    }
}
