<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
class TimeLimitEntryData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $date_now = Carbon::now('Asia/Jakarta');
        
        return $next($request);
    }
}
