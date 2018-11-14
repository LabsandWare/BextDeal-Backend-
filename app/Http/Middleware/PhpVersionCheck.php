<?php

namespace App\Http\Middleware;

use Closure;

class PhpVersionCheck
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
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
          // Ignores notices and reports all other kinds... and warnings
          error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
          // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
        }

        return $next($request);
    }
}
