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

   /**
    *  Access Control Headers.
    * @var array
    */  
    protected $headers = [
      'Access-Control-Allow-Origin' =>  '*',
      'Access-Control-Allow-Methods' => 'POST, GET, DELETE, PUT, OPTIONS',
      'Access-Control-Allow-Headers' => ' Content-Type, Authorization, X-Requested-With',
      'Access-Control_Max-Age' => '86400',
      'Access-Control-Allow-Credentials' => 'true'
    ];

    public function handle($request, Closure $next)
    {   
        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method": "OPTIONS"}', 200, $this->headers);
        }
        
        $response =  $next($request);  
    
        foreach($this->headers as $key => $value) {
          $response->header($key, $value);
        }

        return $response;
    }

}
