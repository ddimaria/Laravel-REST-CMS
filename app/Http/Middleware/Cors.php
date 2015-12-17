<?php namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\Response;

class Cors implements Middleware {

	 /**
	  * Handle an incoming request.
	  *
	  * @param \Illuminate\Http\Request $request
	  * @param \Closure $next
	  * @return mixed
	  */
	 public function handle($request, Closure $next)
	 {
		$response = $next($request);

		$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
		$response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, X-Authorization, Access-Control-Allow-Origin');
		$response->headers->set('Access-Control-Allow-Credentials', 'true');

		return $response;
	 }
}