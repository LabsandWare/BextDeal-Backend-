<?php 

namespace App\Http\Middleware;

use Closure;

/**
* Class to handle CORS
*/
class Cors 
{
  
   /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Closure $next
   *
   * @return mixed
   */

   public function handle($request, Closure $next)
   {
      if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
        # code...
        // Depending of your application you can't use '*'
        // Some security CORS concerns 
        return $next($request)
          ->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', 'POST, GET, DELETE, PUT, PATCH, OPTIONS')
          ->header('Access-Control-Allow-Credentials', 'true')
          ->header('Access-Control-Max-Age', '1728000')
          ->header('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization, X-CSRF-Token');
      } 

      return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Headers', 'Content-Type')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

   }

}
